<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}
/**
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2016 SalesAgility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */
class SuiteMozaik
{
    private $mozaikPath = 'include/javascript/mozaik';
    private $vendorPath;

    private static $defaultThumbnails = array(
        'headline' => array(
            'label' => 'Headline',
            //'tpl' => 'tpls/default/headline.html',
            'tpl' => 'string:<p><h1>Add your headline here..</h1></p>',
            'thumbnail' => 'tpls/default/thumbs/headline.png',
        ),
        'content' => array(
            'label' => 'Content',
            'tpl' => 'string:<h2>Title</h2><p>{lipsum}</p>',
            'thumbnail' => 'tpls/default/thumbs/content1.png',
        ),
        'content2' => array(
            'label' => 'Content with two columns',
            'tpl' => 'string:<table style="width:100%;"><tbody><tr><td><h2>Title</h2></td><td><h2>Title</h2></td></tr><tr><td>{lipsum}</td><td>{lipsum}</td></tr></tbody></table>',
            'thumbnail' => 'tpls/default/thumbs/content2.png',
        ),
        'content3' => array(
            'label' => 'Content with three columns',
            'tpl' => 'string:<table style="width:100%;"><tbody><tr><td><h2>Title</h2></td><td><h2>Title</h2></td><td><h2>Title</h2></td></tr><tr><td>{lipsum}</td><td>{lipsum}</td><td>{lipsum}</td></tr></tbody></table>',
            'thumbnail' => 'tpls/default/thumbs/content3.png',
        ),
        'image1left' => array(
            'label' => 'Content with left image',
            'tpl' => 'string:<table style="width:100%;"><tbody><tr><td>{imageSmall}</td><td><h2>Title</h2>{lipsum}</td></tr></tbody></table>',
            'thumbnail' => 'tpls/default/thumbs/image1left.png',
        ),
        'image1right' => array(
            'label' => 'Content with right image',
            'tpl' => 'string:<table style="width:100%;"><tbody><tr><td><h2>Title</h2>{lipsum}</td><td>{imageSmall}</td></tr></tbody></table>',
            'thumbnail' => 'tpls/default/thumbs/image1right.png',
        ),
        'image2' => array(
            'label' => 'Content with two image',
            'tpl' => 'string:<table style="width:100%;"><tbody><tr><td>{imageSmall}</td><td><h2>Title</h2>{lipsum}</td><td>{imageSmall}</td><td><h2>Title</h2>{lipsum}</td></tr></tbody></table>',
            'thumbnail' => 'tpls/default/thumbs/image2.png',
        ),
        'image3' => array(
            'label' => 'Content with three image',
            'tpl' => 'string:<table style="width:100%;"><tbody><tr><td>{image}</td><td>{image}</td><td>{image}</td></tr><tr><td><h2>Title</h2>{lipsum}</td><td><h2>Title</h2>{lipsum}</td><td><h2>Title</h2>{lipsum}</td></tr></tbody></table>',
            'thumbnail' => 'tpls/default/thumbs/image3.png',
        ),
        'footer' => array(
            'label' => 'Footer',
            //'tpl' => 'tpls/default/footer.html',
            'tpl' => 'string:<p class="footer">Take your footer contents and information here..</p>',
            'thumbnail' => 'tpls/default/thumbs/footer.png',
        ),
    );

    private $thumbsCache = array();

    private $autoInsertThumbnails = true;

    private static $devMode = false;

    /**
     * SuiteMozaik constructor.
     */
    public function __construct()
    {
        $this->vendorPath = $this->mozaikPath.'/vendor';
        if ($this->autoInsertThumbnails) {
            if (count($this->getThumbs()) == 0 || self::$devMode) {
                $ord = 0;
                foreach (self::$defaultThumbnails as $thumbName => $thumbData) {
                    $templateSectionLine = new TemplateSectionLine();
                    $templateSectionLine->name = $thumbData['label'];
                    $templateSectionLine->description = preg_replace('/^string:/', '', $thumbData['tpl']);
                    $templateSectionLine->description = str_replace('{lipsum}', $this->getContentLipsum(), $templateSectionLine->description);
                    $templateSectionLine->description = str_replace('{imageSmall}', $this->getContentImageSample(130), $templateSectionLine->description);
                    $templateSectionLine->description = str_replace('{image}', $this->getContentImageSample(), $templateSectionLine->description);
                    $templateSectionLine->thumbnail = file_exists($this->mozaikPath.'/'.$thumbData['thumbnail']) ? $this->mozaikPath.'/'.$thumbData['thumbnail'] : null;
                    $templateSectionLine->ord = ++$ord;
                    $templateSectionLine->save();
                }
            }
            $this->thumbsCache = array();
        }
    }

    /**
     * return a lorem ipsum text
     * @return string   a 'lorem ipsum text'
     */
    private function getContentLipsum()
    {
        return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam tempus odio ante, in feugiat ex pretium eu. In pharetra tincidunt urna et malesuada. Etiam aliquet auctor justo eu placerat. In nec sollicitudin enim. Nulla facilisi. In viverra velit turpis, et lobortis nunc eleifend id. Curabitur semper tincidunt vulputate. Nullam fermentum pellentesque ullamcorper.';
    }

    /**
     * return a sample image
     * @param int $width    (optional)
     * @return string       html img tag
     */
    private function getContentImageSample($width = null)
    {
        if (is_numeric($width)) {
            $width = ' width="'.$width.'"';
        } else {
            $width = '';
        }
        $splits = explode('index.php', $_SERVER['REQUEST_URI']);
        $url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$splits[0];
        $image = '<img src="'.$url.$this->mozaikPath.'/tpls/default/images/sample.jpg" '.$width.' />';

        return $image;
    }

    /**
     * return mozaik dependencies
     *
     * @return string   html
     */
    public function getDependenciesHTML()
    {
        $html = <<<HTML
<script src='{$this->vendorPath}/tinymce/tinymce/tinymce.min.js'></script>
<script src="{$this->vendorPath}/gymadarasz/imagesloaded/imagesloaded.pkgd.min.js"></script>

<!-- for color picker plugin -->
<link rel="stylesheet" media="screen" type="text/css" href="{$this->vendorPath}/../colorpicker/css/colorpicker.css" />
<script type="text/javascript" src="{$this->vendorPath}/../colorpicker/js/colorpicker.js"></script>
HTML;

        return $html;
    }

    /**
     * @return string   html
     */
    public function getIncludeHTML()
    {
        $html = <<<HTML
<link rel="stylesheet" href="{$this->mozaikPath}/jquery.mozaik.css">
<script src='{$this->mozaikPath}/jquery.mozaik.js'></script>
HTML;

        return $html;
    }

    /**
     * get a mozaik section element
     *
     * @param string $contents      contents
     * @param string $textareaId    used textarea id
     * @param string $elementId     used element id
     * @param string $width         width
     * @param array $thumbs         thumbnails as array
     * @return string               html
     */
    public function getElementHTML($contents = '', $textareaId = null, $elementId = 'mozaik', $width = 'initial', $thumbs = array())
    {
        if (is_numeric($width)) {
            $width .= 'px';
        }
        if (!$thumbs) {
            $thumbs = self::$defaultThumbnails;
        }
        $thumbsJSON = json_encode($thumbs);
        $refreshTextareaScript = '';
        if ($textareaId) {
            $refreshTextareaScript = $this->getRefreshTextareaScript($textareaId, $elementId, $width);
        }
        $html = <<<HTML
<style type="text/css">
#{$elementId} {position: relative; top: 0; left: 0;}
#{$elementId} ul.mozaik-thumbs li.mozaik-thumbnail {padding: 5px 0;}
#{$elementId} ul.mozaik-thumbs li.mozaik-thumbnail:hover {background-color: lightgray;}
#{$elementId} .mozaik-thumbnail.ui-draggable.ui-draggable-handle {cursor: -webkit-grab;}
#{$elementId} .mozaik-thumbnail.ui-draggable.ui-draggable-handle * {cursor: -webkit-grab;}
#{$elementId} .mozaik-thumbnail.ui-draggable.ui-draggable-handle.ui-draggable-dragging {cursor: -webkit-grabbing;}
#{$elementId} .mozaik-thumbnail.ui-draggable.ui-draggable-handle.ui-draggable-dragging * {cursor: -webkit-grabbing;}
</style>
<div id="{$elementId}">{$contents}</div>
<script type="text/javascript">
    $(function() {
        // initialize

        if(typeof window.mozaikSettings == 'undefined') {
            window.mozaikSettings = {};
        }

        window.mozaikSettings.{$elementId} = {
            base: '{$this->mozaikPath}/',
            thumbs: {$thumbsJSON},
            editables: 'editable',
            style: 'tpls/default/styles/default.css',
            namespace: false,
            ace: false,
            width: '{$width}'
        };

        window.plgBackground.image = '{$this->mozaikPath}/' + window.plgBackground.image;

        $('#{$elementId}').mozaik(window.mozaikSettings.{$elementId});

        $(window).mousemove(function(){
            var correction = -( ($('#{$elementId}').width()-100) / 2);
            $('#{$elementId} .mozaik-thumbnail.ui-draggable-dragging').css('margin-left', correction + 'px');
        });

    });
    // refresh textarea
    {$refreshTextareaScript}

</script>
HTML;

        return $html;
    }

    /**
     * get a mozaik output as html
     *
     * @param string $contents      contents
     * @param string $textareaId    use textarea id
     * @param string $elementId     element id
     * @param string $width         width
     * @param string $group         group of template line items
     * @return string               html
     */
    public function getAllHTML($contents = '', $textareaId = null, $elementId = 'mozaik', $width = 'initial', $group = '')
    {
        if (is_numeric($width)) {
            $width .= 'px';
        }
        $mozaikHTML = $this->getDependenciesHTML();
        $mozaikHTML .= $this->getIncludeHTML();
        $thumbs = $this->getThumbs($group);
        $mozaikHTML .= $this->getElementHTML($contents, $textareaId, $elementId, $width, $thumbs);

        return $mozaikHTML;
    }

    /**
     * refresh textarea script
     *
     * @param string $textareaId    use textarea id
     * @param string $elementId     element id
     * @param string $width         with
     * @return string               html
     */
    private function getRefreshTextareaScript($textareaId, $elementId, $width = 'initial')
    {
        if (is_numeric($width)) {
            $width .= 'px';
        }
        $js = <<<SCRIPT
$(window).mouseup(function(){
     $('#{$textareaId}').val($('#{$elementId}').getMozaikValue({width: '{$width}'}));

     // fix table editor panel
     var found = false;
     $('.mce-tinymce').each(function(i,e){
        if(!$(e).hasClass('mce-tinymce-inline-inside') && $(e).css('display') == 'block'){
            found = true;
        }
     });
     if(!found) {
        $('.mce-tinymce-inline-inside').css('display', 'none');
     }
});
SCRIPT;

        return $js;
    }

    /**
     * get thumbnails
     *
     * @param string $group     group of thumbnails
     * @return array            thumbnails
     */
    private function getThumbs($group = '')
    {
        $cacheGroup = 'cached_'.$group;

        if (!isset($this->thumbsCache[$cacheGroup])) {
            $db = DBManagerFactory::getInstance();
            $_group = $db->quote($group);
            $templateSectionLineBean = BeanFactory::getBean('TemplateSectionLine');
            $thumbBeans = $templateSectionLineBean->get_full_list('ord', "(grp LIKE '$_group' OR grp IS NULL)");
            $thumbs = array();
            if ($thumbBeans) {
                foreach ($thumbBeans as $thumbBean) {
                    $thumbs[$thumbBean->name] = array(
                        'label' => $thumbBean->thumbnail ? $this->getThumbImageHTML($thumbBean->thumbnail, $thumbBean->name) : $thumbBean->name,
                        'tpl' => 'string:'.html_entity_decode($thumbBean->description),
                    );
                }
            }
            $this->thumbsCache[$cacheGroup] = $thumbs;
        }

        $thumbs = $this->thumbsCache[$cacheGroup];

        return $thumbs;
    }

    /**
     * get thumbnail image tags or a text if img source not found
     *
     * @param string $src       scr attribute of img tag
     * @param string $label     alt attribute of img tag
     * @return string           html
     */
    private function getThumbImageHTML($src, $label)
    {
        if (file_exists($src)) {
            $html = '<img src="'.$src.'" alt="'.$label.'">';
        } else {
            $html = $label;
        }

        return $html;
    }
}
