<?php
declare(strict_types=1);

namespace Deloitte\Appointment\Model;

use Deloitte\Appointment\Model\ResourceModel\Appointment\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $appointmentCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $appointmentCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $appointmentCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
          if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();
        /** @var Appointment $appointment */
        foreach ($items as $appointment) {
            // our fieldset is called "appointment" or this table so that magento can find its datas:
            $this->loadedData[$appointment->getId()] = $appointment->getData();
        }

        return $this->loadedData;

    }
}
