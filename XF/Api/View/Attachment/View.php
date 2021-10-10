<?php

namespace Truonglv\ImageCacheable\XF\Api\View\Attachment;

use XF\Util\File;

class View extends XFCP_View
{
    /**
     * @return string
     */
    public function renderRaw()
    {
        /** @var \XF\Entity\Attachment $attachment */
        $attachment = $this->params['attachment'];
        $return304 = (bool) $this->params['return304'];
        if (!$return304
            && File::isImageInlineDisplaySafe($attachment->extension)
        ) {
            $this->response->header('Cache-Control', 'public, must-revalidate, max-age=' . (30 * 86400));
        }

        return parent::renderRaw();
    }
}
