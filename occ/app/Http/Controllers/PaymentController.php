<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use PayPal;
use Auth;

class PaymentController extends Controller
{
    private $_apiContext;

    public function __construct()
    {
        $this->_apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret'));

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));

    }

	public function index() {
		return view('payment.index');
	}

    /*
    * Process payment using PayPal express checkout.
    * Either the user is paying for a class or membership.
    */
    // $amount, $usr_email, $class=null, $mem_type=null
    public function create_membership_paypal_payout()
    {

    	$price = Auth::user()->user_profile->membership->membership_type->cost;

	    $payer = PayPal::Payer();
	    $payer->setPaymentMethod('paypal');
	    $payer_info = PayPal::payerInfo();
	    $payer_info->setEmail(Auth::user()->email);
	    $payer->setPayerInfo($payer_info);

	    $item1 = PayPal::Item();
		$item1->setName('Membership type:' . 
						Auth::user()->user_profile->membership->membership_type->name);

		$item1->setCurrency('USD')
    		  ->setQuantity(1)
    		  ->setPrice($price);

		$itemList = PayPal::ItemList();
		$itemList->setItems(array($item1));

		$details = PayPal::Details();
		$details->setShipping(0)
		    	->setTax(0)
		    	->setSubtotal($price);
	    $amount = PayPal::Amount();
	    $amount->setCurrency('USD')
	    	   ->setTotal($price)
	    	   ->setDetails($details);


	    $transaction = PayPal::Transaction();
	    $transaction->setAmount($amount)
	    			->setItemList($itemList);
	    
		$transaction->setDescription('Membership Fees');
		
		$transaction->setInvoiceNumber(uniqid());

	    $redirectUrls = PayPal::RedirectUrls();
	    $redirectUrls->setReturnUrl(config('services.paypal.membership_return_url'));
	    $redirectUrls->setCancelUrl(config('services.paypal.membership_cancel_url'));

	    $payment = PayPal::Payment();
	    $payment->setIntent('sale');
	    $payment->setPayer($payer);
	    $payment->setRedirectUrls($redirectUrls);
	    $payment->setTransactions(array($transaction));
	    $payment->setExperienceProfileId($this->createWebProfile());

	    $response = $payment->create($this->_apiContext);
	    $redirectUrl = $response->links[1]->href;

	    return redirect($redirectUrl);
    }



    public function from_pay_pal(Request $request)
    {

    	$id = $request->get('paymentId');
	    $token = $request->get('token');
	    $payer_id = $request->get('PayerID');

	    $payment = PayPal::getById($id, $this->_apiContext);

	    $paymentExecution = PayPal::PaymentExecution();

	    $paymentExecution->setPayerId($payer_id);
	    $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

	    return view('auth.member_confirmation_pay_by_paypal');
    }

    public function cancelled_pay(Request $request)
    {
    	
    	return $request;
    }



    /**
     * Creates a web profile.  This changes the look of the PayPal express.
     */
    public function createWebProfile()
    {
    	$flowConfig = PayPal::FlowConfig();
    	$presentation = PayPal::Presentation();
    	$inputFields = PayPal::InputFields();
    	$webProfile = PayPal::WebProfile();
    	$flowConfig->setLandingPageType("Billing"); //Set the page type

    	// 190 X 60 target
    	$presentation->setLogoImage("https://www.example.com/images/logo.jpg")->setBrandName("Example ltd");
    	$inputFields->setAllowNote(true)->setNoShipping(1)->setAddressOverride(0);

    	$webProfile->setName("Example " . uniqid())
    	    ->setFlowConfig($flowConfig)
    	    // Parameters for style and presentation.
    	    ->setPresentation($presentation)
    	    // Parameters for input field customization.
    	    ->setInputFields($inputFields);

    	$createProfileResponse = $webProfile->create($this->_apiContext);

   		 return $createProfileResponse->getId(); //The new webprofile's id
    }
}
