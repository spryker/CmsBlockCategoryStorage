<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\Kernel\Widget;

use Spryker\Yves\Kernel\Dependency\Plugin\WidgetPluginInterface;

interface WidgetFactoryInterface
{
    /**
     * @param string $widgetClassName
     * @param array $arguments
     *
     * @throws \Exception
     *
     * @return \Spryker\Yves\Kernel\Dependency\Plugin\WidgetPluginInterface
     */
    public function build(string $widgetClassName, array $arguments = []): WidgetPluginInterface;
}
