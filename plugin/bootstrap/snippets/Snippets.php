<?php
class Snippets
{
    public $snippets;
    public $total_snippets;

    private $xml_file;
    private $xml;
    private $allow_edit   = false;
    private $allow_script = false;
    private $allow_php    = false;
    private $script_found = false;
    private $php_found    = false;

    public function __construct($xml_file, $allow_edit)
    {
        $this->allow_edit   = $allow_edit;
        $this->xml_file    = $xml_file;
    }

    public function getSnippets()
    {
        $this->xml = simplexml_load_file($this->xml_file);
        $this->snippets = $this->xml->snippet;
        $this->total_snippets = count($this->snippets);
    }

    public function render()
    {
        $html = '';
        if (empty($this->total_snippets)) {
            $html .= '<div class="col-xs-12">' . " \n";
            $html .= '<p>&nbsp;</p><p>' . NO_SNIPPET_TO_DISPLAY . '</p>' . " \n";
            $html .= '</div>' . " \n";
        } else {
            for ($i=0; $i < $this->total_snippets; $i++) {
                $snp = $this->snippets[$i];
                $html .= '<div class="col-sm-6">' . " \n";
                $html .= '    <div class="text-center">' . " \n";
                $html .= '        <div class="choice selector select-snippet" data-index="' . $i . '">' . " \n";
                $html .= '            ' . $snp->title;
                $html .= '        </div>' . " \n";
                $html .= '    </div>' . " \n";
                $html .= '</div>' . " \n";
                $html .= '<div class="hidden" id="content-' . $i . '">' . " \n";
                $html .= htmlspecialchars_decode($snp->content);
                $html .= '</div>' . " \n";
            }
        }
        if ($this->allow_edit == 'true') {
            $html .= '<div class="col-sm-6">' . " \n";
            $html .= '    <div class="text-center">' . " \n";
            $html .= '        <button class="btn btn-primary" id="add-new-snippet-btn">' . ADD_NEW_SNIPPET . '</button>' . " \n";
            $html .= '    </div>' . " \n";
            $html .= '</div>' . " \n";
        }

        return $html;
    }

    public function addNewSnippet($title, $content)
    {
        if (!empty($title) && !empty($content)) {
            libxml_use_internal_errors(true); // avoid warnings if using html5 tags with $dom->loadXML
            if ($this->allow_php == false) {
                $title   = $this->removePhp($title);
                $content = $this->removePhp($content);
            }
            if ($this->allow_script == false) {
                $title   = $this->removeScripts($title);
                $content = $this->removeScripts($content);
            }
            $xml = $this->xml;
            $total_snippets = $this->total_snippets;
            $dom = dom_import_simplexml($xml)->ownerDocument;
            $dom = new DOMDocument('1.0');
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->loadXML($xml->asXML());
            $new_snippet = $dom->createElement('snippet');
            $new_title = $dom->createElement('title');
            $new_content = $dom->createElement('content');
            $title_text = $dom->createTextNode($title);
            $content_text = $dom->createTextNode($content);
            $new_title->appendChild($title_text);
            $new_content->appendChild($content_text);
            $new_snippet->appendChild($new_title);
            $new_snippet->appendChild($new_content);
            $dom->documentElement->appendChild($new_snippet);
            $dom->save($this->xml_file);
            $this->getSnippets();
            if ($this->script_found == true) {
                return 'script_forbidden';
            } elseif ($this->php_found == true) {
                return 'php_forbidden';
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
    public function editSnippet($index, $title, $content)
    {
        libxml_use_internal_errors(true); // avoid warnings if using html5 tags with $dom->loadXML
        if ($this->allow_php == false) {
            $title   = $this->removePhp($title);
            $content = $this->removePhp($content);
        }
        if ($this->allow_script == false) {
            $title   = $this->removeScripts($title);
            $content = $this->removeScripts($content);
        }
        $xml = $this->xml;
        $total_snippets = $this->total_snippets;
        $dom = dom_import_simplexml($xml)->ownerDocument;
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
        $new_snippet = $dom->createElement('snippet');
        $new_title = $dom->createElement('title');
        $new_content = $dom->createElement('content');
        $title_text = $dom->createTextNode($title);
        $content_text = $dom->createTextNode($content);
        $new_title->appendChild($title_text);
        $new_content->appendChild($content_text);
        $new_snippet->appendChild($new_title);
        $new_snippet->appendChild($new_content);
        $old_snippet = $dom->documentElement->getElementsByTagName('snippet')->Item($index);
        $dom->documentElement->replaceChild($new_snippet, $old_snippet);
        $dom->save($this->xml_file);
        $this->getSnippets();
        if ($this->script_found == true) {
            return 'script_forbidden';
        } elseif ($this->php_found == true) {
            return 'php_forbidden';
        } else {
            return true;
        }
    }

    public function deleteSnippet($index)
    {
        libxml_use_internal_errors(true); // avoid warnings if using html5 tags with $dom->loadXML
        $xml = $this->xml;
        $total_snippets = $this->total_snippets;
        $dom = dom_import_simplexml($xml)->ownerDocument;
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
        $old_snippet = $dom->documentElement->getElementsByTagName('snippet')->Item($index);
        $dom->documentElement->removeChild($old_snippet);
        $dom->save($this->xml_file);
        $this->getSnippets();

        return true;
    }

    /**
     * Removes unwanted script tags from snippet
     * @param  $snippet_tag
     * @return $snippet_tag
     */
    private function removeScripts($element)
    {
        $dom = new DOMDocument();
        $dom->loadHtml($element);

        $xpath = new DOMXPath($dom);
        while ($node = $xpath->query('//script')->item(0)) {
            $node->parentNode->removeChild($node);
            $this->script_found = true;
        }

        return preg_replace('/^<!DOCTYPE.+?>/', '', str_replace(array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $dom->saveHTML()));
    }

    /**
     * Removes unwanted php scripts from snippet
     * @param  $element    title | content
     * @return $element element cleaned
     */
    private function removePhp($element)
    {
        if (preg_match_all('/<\?php(.+?)\?>/is', $element, $out)) {
            $this->php_found = true;
            $element = preg_replace('/<\?php(.+?)\?>/is', '', $element);
        }

        return $element;
    }
}
