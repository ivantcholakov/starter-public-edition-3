<?php

class __Mustache_48037be6b90b3eb2f4a66c25d4c0dfef extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';

        $buffer .= $indent . '
';
        $buffer .= $indent . 'Hello, ';
        $value = $this->resolveValue($context->find('name'), $context, $indent);
        $buffer .= htmlspecialchars($value, 2, 'UTF-8');
        $buffer .= '!
';

        return $buffer;
    }
}
