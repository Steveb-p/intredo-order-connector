<?php
namespace Intredo\OrderConnector;

class PatchOrder implements \JsonSerializable
{

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
    private $mainIncome;

    /**
     * @var string
     */
    private $conversionCurrency;

    /**
     * @var string
     */
    private $conversionExtraIncome;

    /**
     * @var Package[]
     */
    private $packages = [];

    /**
     * @var string
     */
    private $upsellIncome;

    /**
     * PatchOrder constructor.
     * @param string|int $orderNo
     */
    public function __construct($orderNo)
    {
        $this->orderNo = $orderNo;
    }

    /**
     * @param string $clientId
     * @return PatchOrder
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @param string $countryIso
     * @return PatchOrder
     */
    public function setCountryIso($countryIso)
    {
        $this->countryIso = $countryIso;
        return $this;
    }

    /**
     * @param bool $confirmed_1
     * @return PatchOrder
     */
    public function setConfirmed1($confirmed_1)
    {
        $this->confirmed_1 = $confirmed_1;
        return $this;
    }

    /**
     * @param bool $confirmed_2
     * @return PatchOrder
     */
    public function setConfirmed2($confirmed_2)
    {
        $this->confirmed_2 = $confirmed_2;
        return $this;
    }

    /**
     * @param bool $fraud
     * @return PatchOrder
     */
    public function setFraud($fraud)
    {
        $this->fraud = $fraud;
        return $this;
    }

    /**
     * @param bool $test
     * @return PatchOrder
     */
    public function setTest($test)
    {
        $this->test = $test;
        return $this;
    }

    /**
     * @param AddressData $addressData
     * @return PatchOrder
     */
    public function setAddressData(AddressData $addressData)
    {
        $this->addressData = $addressData;
        return $this;
    }

    /**
     * @param string $income
     * @return PatchOrder
     */
    public function setMainIncome($income)
    {
        if (!is_numeric($income)) {
            throw new \InvalidArgumentException('Main income should be numeric');
        }
        $this->mainIncome = $income;
        return $this;
    }

    /**
     * @param string $conversionCurrency
     * @return PatchOrder
     */
    public function setConversionCurrency($conversionCurrency)
    {
        if (strlen($conversionCurrency) !== 3) {
            throw new \InvalidArgumentException('Conversion Currency should be 3 letter long iso code');
        }
        $this->conversionCurrency = $conversionCurrency;
        return $this;
    }

    /**
     * @param string $conversionExtraIncome
     * @return PatchOrder
     */
    public function setConversionExtraIncome($conversionExtraIncome)
    {
        if (!is_numeric($conversionExtraIncome)) {
            throw new \InvalidArgumentException('Conversion extra income should be numeric');
        }
        $this->conversionExtraIncome = $conversionExtraIncome;
        return $this;
    }

    /**
     * @param Package $package
     * @return PatchOrder
     */
    public function addPackage(Package $package)
    {
        $this->packages[] = $package;
        return $this;
    }

    /**
     * @param string $upsellIncome
     * @return PatchOrder
     */
    public function setUpsellIncome($upsellIncome)
    {
        if (!is_numeric($upsellIncome)) {
            throw new \InvalidArgumentException('Upsell income should be numeric');
        }
        $this->upsellIncome = $upsellIncome;
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
            'type' => 'order_patch',
            'order_no' => $this->orderNo,
            'country_iso' => $this->countryIso,
            'client_id' => $this->clientId,
            'confirmed_1' => $this->confirmed_1,
            'confirmed_2' => $this->confirmed_2,
            'is_fraud' => $this->fraud,
            'is_test' => $this->test,
            'address_data' => $this->addressData,
            'cost' => $this->mainIncome,
            'conversionCurrency' => $this->conversionCurrency,
            'extra_cost' => $this->conversionExtraIncome,
            'package' => $this->packages,
            'upsell_cost' => $this->upsellIncome,
        ]);
    }
}
