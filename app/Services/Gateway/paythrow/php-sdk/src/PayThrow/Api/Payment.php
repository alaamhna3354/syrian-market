<?php
namespace PayThrow\Api;

use PayThrow\Common\PayThrowModel;

/**
 * Class Payment
 * @property \PayThrow\Api\Payer payer
 * @property \PayThrow\Api\Transaction transaction
 * @property \PayThrow\Api\RedirectUrls redirectUrls
 * @property array credentials
 * @property string approvedUrl
 *
 */
class Payment extends PayThrowModel
{

    /**
     * @param \PayThrow\Api\Payer $payer
     *
     * @return $this
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;
        return $this;
    }

    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * @param \PayThrow\Api\Transaction $transaction
     *
     * @return $this
     */
    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;
        return $this;
    }

    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * @param \PayThrow\Api\RedirectUrls $redirectUrls
     *
     * @return $this
     */
    public function setRedirectUrls($redirectUrls)
    {
        $this->redirectUrls = $redirectUrls;
        return $this;
    }

    public function getRedirectUrls()
    {
        return $this->redirectUrls;
    }

    /**
     * @param array $credentials
     *
     * @return $this
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;
        return $this;
    }

    public function getCredentials()
    {
        return $this->credentials;
    }

    public function setApprovedUrl($url)
    {
        $this->approvedUrl = $url;
        return $this;
    }

    public function getApprovedUrl()
    {
        return $this->approvedUrl;
    }

    public function create()
    {
        $accessToken = $this->getAccessToken();
        $approveUrl  = $this->sendTransactionInfo($accessToken);
        $this->setApprovedUrl($approveUrl);
    }

    private function getAccessToken()
    {
        $array = $this->getCredentials();
        if (!$array['client_id'] || !$array['client_secret'])
        {
            echo 'Parameter array must contain with client_id, client_secret.';
            exit;
        }
        $client_id                = $array['client_id'];
        $client_secret            = $array['client_secret'];
        $payload['client_id']     = $client_id;
        $payload['client_secret'] = $client_secret;

        $res = $this->execute(BASE_URL . 'merchant/api/verify', 'post', $payload);
        $res = json_decode($res);

        if (!$res)
        {
            echo "Please check you client iD or client secret again";
            exit;
        }

        if ($res->status == 'error')
        {
            echo $res->message;exit;
        }
        $response = $res->data->access_token;

        return $response;
    }

    private function sendTransactionInfo($token)
    {
        $trans        = $this->getTransaction();
        $payer        = $this->getPayer();
        $redirectUrls = $this->getRedirectUrls();

        $amount        = $trans->amount->getTotal();
        $currency      = $trans->amount->getCurrency();
        $successUrl     = $redirectUrls->getSuccessUrl();
        $cancelUrl     = $redirectUrls->getCancelUrl();
        $paymentMethod = $payer->getPaymentMethod();

        $req['payer']     = $paymentMethod;
        $req['amount']    = $amount;
        $req['currency']  = $currency;
        $req['successUrl'] = $successUrl;
        $req['cancelUrl'] = $cancelUrl;

        $header = ['Authorization: Bearer ' . $token];

        $res = $this->execute(BASE_URL . 'merchant/api/transaction-info', 'POST', $req, $header);
        $res = json_decode($res);

        if (!$res)
        {
            echo "Please check your transaction details again !";
            exit;
        }

        if ($res->status == 'error')
        {
            echo $res->message;exit;
        }

        $response = $res->data->approvedUrl;
        return $response;
    }

}