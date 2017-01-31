<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ZedRequest;

use Generated\Shared\Transfer\MessageTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;

interface ZedRequestClientInterface
{

    /**
     * @api
     *
     * @param string $url
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $object
     * @param int|null $timeoutInSeconds
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function call($url, TransferInterface $object, $timeoutInSeconds = null);

    /**
     * @api
     *
     * @return MessageTransfer[]
     */
    public function getLastResponseInfoMessages();

    /**
     * @api
     *
     * @return MessageTransfer[]
     */
    public function getLastResponseErrorMessages();

    /**
     * @api
     *
     * @return MessageTransfer[]
     */
    public function getLastResponseSuccessMessages();

}
