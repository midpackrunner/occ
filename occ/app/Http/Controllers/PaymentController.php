<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use PayPal;
use Auth;
use Carbon;
use App\TempPaypalClassSignup;
use App\Classes;
use App\Pet;
use App\MembershipVerifiedPayments;
use App\Http\Controllers\ClassController;


class PaymentController extends Controller
{
    private $_apiContext;

    public function __construct()
    {
        $this->_apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret'));

        $this->_apiContext->setConfig(array(
            'mode' => 'live',
            'service.EndPoint' => 'https://api.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));
        $this->middleware('auth');
    }

	public function index() {
		return view('payment.index');
	}

	public function membership_pay_by_check()
	{
		return view('auth.member_confirmation_pay_by_check');
	}

    /*
    * Process membership payment using PayPal express checkout.
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

    /**
     * Completes PayPal payment.  After user has been redirected
     * to express checkout, the request is sent back here.  This
     * method finishes the "accepting" payment phase.  Transaction
     * is finalized here.
     *
     * @return     Confirmation of membership payment
     */
    public function membership_from_pay_pal(Request $request)
    {

    	$id = $request->get('paymentId');
	    $token = $request->get('token');
	    $payer_id = $request->get('PayerID');

	    $payment = PayPal::getById($id, $this->_apiContext);
	    $paymentExecution = PayPal::PaymentExecution();
	    $paymentExecution->setPayerId($payer_id);
	    $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

	    $pop = new MembershipVerifiedPayments();
	    $pop->date_verified = Carbon::now();
	    $pop->verified_by = 'paypal_auto';
	    $pop->membership_id = Auth::user()->user_profile
	    								  ->membership->id;
	    $pop->save();

	    Auth::user()->user_profile->membership
						   ->verified_payments()->save($pop);

	    return view('auth.member_confirmation_pay_by_paypal');
    }

    /**
     * Handles when a User declines to pay through pay pal express.
     *
     */
    public function member_cancel_pay_by_paypal(Request $request)
    {
    	
    	
    	return view('auth.member_cancel_pay_by_paypal');
    }

    /**
     * Redirect user to pay pal checkout for membership renewal.
     */
    public function renew_membership_paypal_payout($mem_id)
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
        $redirectUrls->setReturnUrl(config('services.paypal.membership_renewal_return_url'). "/" . $mem_id . "/");
        $redirectUrls->setCancelUrl(config('services.paypal.membership_renewal_cancel_url'));

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

    /**
     * Completes PayPal payment.  After user has been redirected
     * to express checkout, the request is sent back here.  This
     * method finishes the "accepting" payment phase.  Transaction
     * is finalized here.
     *
     * @return     confirmation page
     */
    public function member_renewal_confirmation_pay_by_paypal(Request $request, $mem_id)
    {
        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');

        $payment = PayPal::getById($id, $this->_apiContext);
        $paymentExecution = PayPal::PaymentExecution();
        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        $pop = new MembershipVerifiedPayments();
        $pop->date_verified = Carbon::now();
        $pop->verified_by = 'paypal_auto';
        $pop->membership_id = Auth::user()->user_profile
                                          ->membership->id;
        $pop->save();

        Auth::user()->user_profile->membership
                           ->verified_payments()->save($pop);

        $membership = Auth::user()->user_profile->membership;
        $membership->membership_type_id = $mem_id;
        $membership->payment_method = "paypal";
        $old_yr = substr($membership->end_date, 0, 4);
        $membership->end_date = Carbon::createFromDate($old_yr + 1, 1, 1);
        $membership->save();

        return view('memberships.member_renewal_confirmation_pay_by_paypal');        
    }

    public function member_renewal_cancel_pay_by_paypal(Request $request)
    {
        return view('memberships.member_renewal_cancel_pay_by_paypal');
    }


    public function class_pay_with_pay_pal(Request $request, $token)
    {
        $temp_class_record = TempPaypalClassSignup::where('token', '=', $token)->first();
        $class = Classes::findOrFail($temp_class_record->class_id);
        $pet = Pet::findOrFail($temp_class_record->pet_id);
        $price = $temp_class_record->pay_amount;

        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');
        $payer_info = PayPal::payerInfo();
        $payer_info->setEmail(Auth::user()->email);
        $payer->setPayerInfo($payer_info);

        $item1 = PayPal::Item();
        $item1->setName('Payment for ' . $pet->name . 
                        "'s attendance to " .$class->details->title);

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
        
        $transaction->setDescription('Class Registration Fees');
        
        $transaction->setInvoiceNumber(uniqid());

        $redirectUrls = PayPal::RedirectUrls();
        $redirectUrls->setReturnUrl(config('services.paypal.class_confirmation_paypal'). "/" . $token . "/");
        $redirectUrls->setCancelUrl(config('services.paypal.class_cancel_paypal'). "/" . $token . "/");

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

    public function class_confirmation_paypal(Request $request, $token)
    {
        
        $id = $request->get('paymentId');
        $payer_id = $request->get('PayerID');

        $payment = PayPal::getById($id, $this->_apiContext);
        $paymentExecution = PayPal::PaymentExecution();
        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        $temp_class_record = TempPaypalClassSignup::where('token', '=', $token)->first();
        $class_id = $temp_class_record->class_id;
        $pet_id = $temp_class_record->pet_id;
        ClassController::handle_class_sign_up($class_id, $pet_id, $token);
        $class = Classes::findOrFail($class_id);
        $pet = Pet::findOrFail($pet_id);
        return view('classes.sign_up_confirmation_paypal', compact('class', 'pet'));
    }

    public function class_cancel_paypal(Request $request, $token)
    {
        $tmp = TempPaypalClassSignup::where('token', $token)->first();
        $tmp->delete();
        return view('classes.sign_up_paypal_cancelled');
    }


    /**
     * Creates a web profile.  This changes the look of the 
     * PayPal express.  Removes the Shipping Address as it is 
     * not needed for membership payments.
     */
    public function createWebProfile()
    {
    	$flowConfig = PayPal::FlowConfig();
    	$presentation = PayPal::Presentation();
    	$inputFields = PayPal::InputFields();
    	$webProfile = PayPal::WebProfile();
    	$flowConfig->setLandingPageType("Billing"); //Set the page type

    	// 190 X 60 target
    	//$presentation->setLogoImage("68.169.149.104/img/occ_brand.png")
    	$presentation->setBrandName("Obedience Club of Chattanooga");
    	$inputFields->setAllowNote(true)->setNoShipping(1)->setAddressOverride(0);

    	$webProfile->setName("OCC " . uniqid())
    	    ->setFlowConfig($flowConfig)
    	    // Parameters for style and presentation.
    	    ->setPresentation($presentation)
    	    // Parameters for input field customization.
    	    ->setInputFields($inputFields);

    	$createProfileResponse = $webProfile->create($this->_apiContext);

   		 return $createProfileResponse->getId(); //The new webprofile's id
    }
}
