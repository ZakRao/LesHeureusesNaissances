<?php

namespace MessagerieBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MessagerieBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSMessageBundle';
    }
}
