<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_ImportExportCategories
 * @copyright   Copyright (c) Mageplaza (http://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

namespace Mageplaza\ImportExportCategories\Plugin\Model\Source\Import;

use Magento\Framework\AuthorizationInterface;
use Magento\ImportExport\Model\Source\Import\Entity as ImportEntity;

/**
 * Class Entity
 * @package Mageplaza\ImportExportCategories\Plugin\Model\Source\Import
 */
class Entity
{
    /**
     * @var AuthorizationInterface
     */
    protected $_authorization;

    /**
     * Entity constructor.
     *
     * @param AuthorizationInterface $authorization
     */
    public function __construct(AuthorizationInterface $authorization)
    {
        $this->_authorization = $authorization;
    }

    /**
     * @param ImportEntity $subject
     * @param array $result
     * @SuppressWarnings(Unused)
     *
     * @return array
     */
    public function afterToOptionArray(ImportEntity $subject, $result)
    {
        if (!$this->_authorization->isAllowed('Mageplaza_ImportExportCategories::mp_import')) {
            foreach ($result as $key => $item) {
                if ($item['value'] == 'mageplaza_categories_import') {
                    unset($result[$key]);
                }
            }
        }

        return $result;
    }
}
