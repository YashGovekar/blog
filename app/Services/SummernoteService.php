<?php

namespace App\Services;

use DOMDocument;

class SummernoteService
{
    private FileService $fileSvc;

    /**
     * SummernoteService constructor.
     * @param FileService $fileSvc
     */
    public function __construct(FileService $fileSvc)
    {
        $this->fileSvc = $fileSvc;
    }

    public function processText($text)
    {
        if (strlen($text) > 0) {
            $dom = new DomDocument();
            @$dom->loadHtml($text, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');

            foreach ($images as $img) {
                $base64 = $img->getAttribute('src');
                $image_src = $this->fileSvc->storeBase64Image($base64, 'content_images');
                $img->removeAttribute('src');
                $img->setAttribute('src', url($image_src));
            }

            return $dom->saveHTML();
        }

        return $text;
    }
}
