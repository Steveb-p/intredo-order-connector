<?php

namespace Intredo\OrderConnector;

class Order implements \JsonSerializable
{

    /**
     * @var string
     */
    private $cookieId;

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $orderNo;

    /**
     * @var string
     */
    private $countryIso;

    /**
     * @var \DateTimeInterface
     */
    private $createdAt;

    /**
     * @var bool
     */
    private $confirmed_1 = false;

    /**
     * @var bool
     */
    private $confirmed_2 = false;

    /**
     * @var bool
     */
    private $fraud = false;

    /**
     * @var bool
     */
    private $test = false;

    /**
     * @var AddressData
     */
    private $addressData;

    /**
     * @var string
     */
    private $cost;

    /**
     * @var string
     */
    private $conversionCurrency;

    /**
     * @var string
     */
    private $extraCost;

    /**
     * @var string
     */
    private $ref;

    /**
     * @var string
     */
    private $adref;

    /**
     * @var string
     */
    private $pathId;

    /**
     * @var Package[]
     */
    private $packages = [];

    /**
     * @var string
     */
    private $userIp;

    /**
     * @var string
     */
    private $userBrowser;

    /**
     * @var string
     */
    private $userOs;

    /**
     * @var string
     */
    private $userResolution;

    /**
     * @var string
     */
    private $upsellCost;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @param string $cookieId
     * @return Order
     */
    public function setCookieId(string $cookieId): self
    {
        $this->cookieId = $cookieId;
        return $this;
    }

    /**
     * @param string $clientId
     * @return Order
     */
    public function setClientId(string $clientId): self
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @param string $orderNo
     * @return Order
     */
    public function setOrderNo(string $orderNo): self
    {
        $this->orderNo = $orderNo;
        return $this;
    }

    /**
     * @param string $countryIso
     * @return Order
     */
    public function setCountryIso(string $countryIso): self
    {
        $this->countryIso = $countryIso;
        return $this;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return Order
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @param bool $confirmed_1
     * @return Order
     */
    public function setConfirmed1(bool $confirmed_1): self
    {
        $this->confirmed_1 = $confirmed_1;
        return $this;
    }

    /**
     * @param bool $confirmed_2
     * @return Order
     */
    public function setConfirmed2(bool $confirmed_2): self
    {
        $this->confirmed_2 = $confirmed_2;
        return $this;
    }

    /**
     * @param bool $fraud
     * @return Order
     */
    public function setFraud(bool $fraud): self
    {
        $this->fraud = $fraud;
        return $this;
    }

    /**
     * @param bool $test
     * @return Order
     */
    public function setTest(bool $test): self
    {
        $this->test = $test;
        return $this;
    }

    /**
     * @param AddressData $addressData
     * @return Order
     */
    public function setAddressData(AddressData $addressData): self
    {
        $this->addressData = $addressData;
        return $this;
    }

    /**
     * @param string $cost
     * @return Order
     */
    public function setCost(string $cost): self
    {
        if (! is_numeric($cost)) {
            throw new \InvalidArgumentException('Cost should be numeric');
        }
        $this->cost = $cost;
        return $this;
    }

    /**
     * @param string $conversionCurrency
     * @return Order
     */
    public function setConversionCurrency(string $conversionCurrency): self
    {
        if (strlen($conversionCurrency) !== 3) {
            throw new \InvalidArgumentException('Conversion Currency should be 3 letter long iso code');
        }
        $this->conversionCurrency = $conversionCurrency;
        return $this;
    }

    /**
     * @param string $extraCost
     * @return Order
     */
    public function setExtraCost(string $extraCost): self
    {
        if (! is_numeric($extraCost)) {
            throw new \InvalidArgumentException('Extra Cost should be numeric');
        }
        $this->extraCost = $extraCost;
        return $this;
    }

    /**
     * @param string $ref
     * @return Order
     */
    public function setRef(string $ref): self
    {
        $this->ref = $ref;
        return $this;
    }

    /**
     * @param string $adref
     * @return Order
     */
    public function setAdref(string $adref): self
    {
        $this->adref = $adref;
        return $this;
    }

    /**
     * @param string $pathId
     * @return Order
     */
    public function setPathId($pathId)
    {
        $this->pathId = $pathId;
        return $this;
    }

    /**
     * @param Package $package
     * @return Order
     */
    public function addPackage(Package $package): self
    {
        $this->packages[] = $package;
        return $this;
    }

    /**
     * @param string $userIp
     * @return Order
     */
    public function setUserIp(string $userIp): self
    {
        $this->userIp = $userIp;
        return $this;
    }

    /**
     * @param string $userBrowser
     * @return Order
     */
    public function setUserBrowser(string $userBrowser): self
    {
        $this->userBrowser = $userBrowser;
        return $this;
    }

    /**
     * @param string $userOs
     * @return Order
     */
    public function setUserOs(string $userOs): self
    {
        $this->userOs = $userOs;
        return $this;
    }

    /**
     * @param string $userResolution
     * @return Order
     */
    public function setUserResolution(string $userResolution): self
    {
        $this->userResolution = $userResolution;
        return $this;
    }

    /**
     * @param string $upsellCost
     * @return Order
     */
    public function setUpsellCost(string $upsellCost): self
    {
        if (! is_numeric($upsellCost)) {
            throw new \InvalidArgumentException('Upsell Cost should be numeric');
        }
        $this->upsellCost = $upsellCost;
        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return array_filter([
            'type' => 'sale',
            'cookie_id' => $this->cookieId,
            'order_no' => $this->orderNo,
            'country_iso' => $this->countryIso,
            'client_id' => $this->clientId,
            'created_at' => $this->createdAt->getTimestamp(),
            'confirmed' => false,
            'confirmed_1' => $this->confirmed_1,
            'confirmed_2' => $this->confirmed_2,
            'is_fraud' => $this->fraud,
            'is_test' => $this->test,
            'address_data' => $this->addressData,
            'cost' => $this->cost,
            'conversionCurrency' => $this->conversionCurrency,
            'extra_cost' => $this->extraCost,
            'ref' => $this->ref,
            'ad_ref' => $this->adref,
            'algo_id' => '',
            'path_id' => $this->pathId,
            'package' => $this->packages,
            'user_ip' => $this->userIp,
            'user_browser' => $this->userBrowser,
            'user_os' => $this->userOs,
            'user_resolution' => $this->userResolution,
            'upsell_cost' => $this->upsellCost,
        ]);
    }
}
