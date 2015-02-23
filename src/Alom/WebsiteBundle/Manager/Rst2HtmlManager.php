<?php

namespace Alom\WebsiteBundle\Manager;

use ezcDocumentRst;

class Rst2HtmlManager
{
    public function __construct()
    {

    }

    public function convert($markdown)
    {
        $document = new ezcDocumentRst();
        $document->options->xhtmlVisitor = 'ezcDocumentRstXhtmlBodyVisitor';
        $document->loadString($markdown);
        $xhtml = $document->getAsXhtml();
        $xml = $xhtml->save();
        return $xml;
    }

}
