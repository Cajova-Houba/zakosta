<?php

/**
 * Helper class which will translate page names to number parameters.
 */
class PageNameResolver
{
    const HOME_PAGE_NAME = "home";
    const WORK_PAGE_NAME = "work";
    const CONTACT_PAGE_NAME = "contact";
    const GALLERY_PAGE_NAME = "gallery";
    const SENDMAIL_PAGE_NAME = "sendmail";

    public static $HOME_PAGE;
    public static $WORK_PAGE;
    public static $CONTACT_PAGE;
    public static $GALLERY_PAGE;
    public static $SENDMAIL_PAGE;

    private $_pageName;

    private $_pageNum;

    /**
     * Initializes static fields. Should be called right after class definition.
     */
    public static function init() {
        PageNameResolver::$HOME_PAGE = new PageNameResolver(PageNameResolver::HOME_PAGE_NAME, 0);
        PageNameResolver::$WORK_PAGE = new PageNameResolver(PageNameResolver::WORK_PAGE_NAME, 1);
        PageNameResolver::$CONTACT_PAGE = new PageNameResolver(PageNameResolver::CONTACT_PAGE_NAME, 2);
        PageNameResolver::$GALLERY_PAGE = new PageNameResolver(PageNameResolver::GALLERY_PAGE_NAME, 3);
        PageNameResolver::$SENDMAIL_PAGE = new PageNameResolver(PageNameResolver::SENDMAIL_PAGE_NAME, 4);
    }

    /**
     * Checks page name and if it's correct returns the right constant ($HOME_PAGE, ...)
     * if it's not, $HOME_PAGE is returned.
     *
     * @param $pageName
     */
    public static function checkPageName($pageName) {
        switch ($pageName) {
            case PageNameResolver::HOME_PAGE_NAME:
                return PageNameResolver::$HOME_PAGE;
                break;
            case PageNameResolver::WORK_PAGE_NAME:
                return PageNameResolver::$WORK_PAGE;
                break;
            case PageNameResolver::CONTACT_PAGE_NAME:
                return PageNameResolver::$CONTACT_PAGE;
                break;
            case PageNameResolver::GALLERY_PAGE_NAME:
                return PageNameResolver::$GALLERY_PAGE;
                break;
            case PageNameResolver::SENDMAIL_PAGE_NAME:
                return PageNameResolver::$SENDMAIL_PAGE;
                break;
            default:
                return PageNameResolver::$HOME_PAGE;
                break;
        }
    }

    /**
     * PageNameResolver constructor.
     * @param $pageName
     * @param $pageNum
     */
    public function __construct($pageName, $pageNum)
    {
        $this->_pageName = $pageName;
        $this->_pageNum = $pageNum;
    }

    public function pageName() {
        return $this->_pageName;
    }

    public function pageNum() {
        return $this->_pageNum;
    }

}
PageNameResolver::init();