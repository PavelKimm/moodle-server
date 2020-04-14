<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version details
 *
 * @package   theme_adaptable
 * @copyright 2015-2019 Jeremy Hopkins (Coventry University)
 * @copyright 2015-2019 Fernando Acedo (3-bits.com)
 * @copyright 2017-2019 Manoj Solanki (Coventry University)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

defined('MOODLE_INTERNAL') || die;

define('THEME_ADAPTABLE_DEFAULT_ALERTCOUNT', '1');
define('THEME_ADAPTABLE_DEFAULT_ANALYTICSCOUNT', '1');
define('THEME_ADAPTABLE_DEFAULT_TOPMENUSCOUNT', '1');
define('THEME_ADAPTABLE_DEFAULT_TOOLSMENUSCOUNT', '1');
define('THEME_ADAPTABLE_DEFAULT_NEWSTICKERCOUNT', '1');
define('THEME_ADAPTABLE_DEFAULT_SLIDERCOUNT', '3');



/**
 * Parses CSS before it is cached.
 *
 * This function can make alterations and replace patterns within the CSS.
 *
 * @param string $css The CSS
 * @param theme_config $theme The theme config object.
 * @return string The parsed CSS The parsed CSS.
 */
function theme_adaptable_process_css($css, $theme) {

    // Set category custom CSS.
    $css = theme_adaptable_set_categorycustomcss($css, $theme->settings);

    // Set custom CSS.
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = theme_adaptable_set_customcss($css, $customcss);

    // Define the default settings for the theme in case they've not been set.
    $defaults = array(
        '[[setting:linkcolor]]' => '#51666C',
        '[[setting:linkhover]]' => '#009688',
        '[[setting:maincolor]]' => '#3A454b',
        '[[setting:backcolor]]' => '#FFFFFF',
        '[[setting:regionmaincolor]]' => '#FFFFFF',
        '[[setting:rendereroverlaycolor]]' => '#3A454b',
        '[[setting:rendereroverlayfontcolor]]' => '#FFFFFF',
        '[[setting:buttoncolor]]' => '#51666C',
        '[[setting:buttontextcolor]]' => '#ffffff',
        '[[setting:buttonhovercolor]]' => '#009688',
        '[[setting:buttoncolorscnd]]' => '#51666C',
        '[[setting:buttontextcolorscnd]]' => '#ffffff',
        '[[setting:buttonhovercolorscnd]]' => '#009688',
        '[[setting:buttoncolorcancel]]' => '#ef5350',
        '[[setting:buttontextcolorcancel]]' => '#ffffff',
        '[[setting:buttonhovercolorcancel]]' => '#e53935',
        '[[setting:buttonlogincolor]]' => '#ef5350',
        '[[setting:buttonloginhovercolor]]' => '#e53935',
        '[[setting:buttonlogintextcolor]]' => '#0084c2',
        '[[setting:buttonloginpadding]]' => '0px',
        '[[setting:buttonloginheight]]' => '24px',
        '[[setting:buttonloginmargintop]]' => '2px',
        '[[setting:buttonradius]]' => '5px',
        '[[setting:buttondropshadow]]' => '0px',
        '[[setting:dividingline]]' => '#ffffff',
        '[[setting:dividingline2]]' => '#ffffff',
        '[[setting:breadcrumb]]' => '#b4bbbf',
        '[[setting:breadcrumbtextcolor]]' => '#444444',
        '[[setting:breadcrumbseparator]]' => 'angle-right',
        '[[setting:loadingcolor]]' => '#00B3A1',
        '[[setting:messagepopupbackground]]' => '#fff000',
        '[[setting:messagepopupcolor]]' => '#333333',
        '[[setting:messagingbackgroundcolor]]' => '#FFFFFF',
        '[[setting:footerbkcolor]]' => '#424242',
        '[[setting:footertextcolor]]' => '#ffffff',
        '[[setting:footertextcolor2]]' => '#ffffff',
        '[[setting:footerlinkcolor]]' => '#ffffff',
        '[[setting:headerbkcolor]]' => '#00796B',
        '[[setting:headerbkcolor2]]' => '#009688',
        '[[setting:headertextcolor]]' => '#ffffff',
        '[[setting:headertextcolor2]]' => '#ffffff',
        '[[setting:msgbadgecolor]]' => '#E53935',
        '[[setting:blockbackgroundcolor]]' => '#FFFFFF',
        '[[setting:blockheaderbackgroundcolor]]' => '#FFFFFF',
        '[[setting:blockbordercolor]]' => '#59585D',
        '[[setting:blockregionbackgroundcolor]]' => 'transparent',
        '[[setting:selectiontext]]' => '#000000',
        '[[setting:selectionbackground]]' => '#00B3A1',
        '[[setting:marketblockbordercolor]]' => '#e8eaeb',
        '[[setting:marketblocksbackgroundcolor]]' => 'transparent',
        '[[setting:blockheaderbordertop]]' => '1px',
        '[[setting:blockheaderborderleft]]' => '0px',
        '[[setting:blockheaderborderright]]' => '0px',
        '[[setting:blockheaderborderbottom]]' => '0px',
        '[[setting:blockmainbordertop]]' => '0px',
        '[[setting:blockmainborderleft]]' => '0px',
        '[[setting:blockmainborderright]]' => '0px',
        '[[setting:blockmainborderbottom]]' => '0px',
        '[[setting:blockheaderbordertopstyle]]' => 'dashed',
        '[[setting:blockmainbordertopstyle]]' => 'solid',
        '[[setting:blockheadertopradius]]' => '0px',
        '[[setting:blockheaderbottomradius]]' => '0px',
        '[[setting:blockmaintopradius]]' => '0px',
        '[[setting:blockmainbottomradius]]' => '0px',
        '[[setting:coursesectionbgcolor]]' => '#FFFFFF',
        '[[setting:coursesectionheaderbg]]' => '#FFFFFF',
        '[[setting:coursesectionheaderbordercolor]]' => '#F3F3F3',
        '[[setting:coursesectionheaderborderstyle]]' => '',
        '[[setting:coursesectionheaderborderwidth]]' => '',
        '[[setting:coursesectionheaderborderradiustop]]' => '',
        '[[setting:coursesectionheaderborderradiusbottom]]' => '',
        '[[setting:coursesectionborderstyle]]' => '1px',
        '[[setting:coursesectionborderwidth]]' => '',
        '[[setting:coursesectionbordercolor]]' => '#e8eaeb',
        '[[setting:coursesectionborderradius]]' => '',
        '[[setting:coursesectionactivityiconsize]]' => '24px',
        '[[setting:coursesectionactivityheadingcolour]]' => '#0066cc',
        '[[setting:coursesectionactivityborderwidth]]' => '2px',
        '[[setting:coursesectionactivityborderstyle]]' => 'dashed',
        '[[setting:coursesectionactivitybordercolor]]' => '#eeeeee',
        '[[setting:coursesectionactivityleftborderwidth]]' => '3px',
        '[[setting:coursesectionactivityassignleftbordercolor]]' => '#0066cc',
        '[[setting:coursesectionactivityassignbgcolor]]' => '#FFFFFF',
        '[[setting:coursesectionactivityforumleftbordercolor]]' => '#990099',
        '[[setting:coursesectionactivityforumbgcolor]]' => '#FFFFFF',
        '[[setting:coursesectionactivityquizleftbordercolor]]' => '#FF3333',
        '[[setting:coursesectionactivityquizbgcolor]]' => '#FFFFFF',
        '[[setting:coursesectionactivitymargintop]]' => '2px',
        '[[setting:coursesectionactivitymarginbottom]]' => '2px',
        '[[setting:tilesbordercolor]]' => '#3A454b',
        '[[setting:slidermargintop]]' => '20px',
        '[[setting:slidermarginbottom]]' => '20px',
        '[[setting:currentcolor]]' => '#d9edf7',
        '[[setting:sectionheadingcolor]]' => '#3A454b',
        '[[setting:menufontsize]]' => '14px',
        '[[setting:menufontpadding]]' => '20px',
        '[[setting:topmenufontsize]]' => '14px',
        '[[setting:menubkcolor]]' => '#ffffff',
        '[[setting:menufontcolor]]' => '#444444',
        '[[setting:menuhovercolor]]' => '#00B3A1',
        '[[setting:menubordercolor]]' => '#00B3A1',
        '[[setting:mobilemenubkcolor]]' => '#F9F9F9',
        '[[setting:mobileslidebartabbkcolor]]' => '#F9F9F9',
        '[[setting:mobileslidebartabiconcolor]]' => '#000000',
        '[[setting:navbardropdownborderradius]]' => '0px',
        '[[setting:navbardropdownhovercolor]]' => '#EEE',
        '[[setting:navbardropdowntextcolor]]' => '#007',
        '[[setting:navbardropdowntexthovercolor]]' => '#000',
        '[[setting:navbardropdowntransitiontime]]' => '0.0s',
        '[[setting:covbkcolor]]' => '#3A454b',
        '[[setting:covfontcolor]]' => '#ffffff',
        '[[setting:editonbk]]' => '#4caf50',
        '[[setting:editoffbk]]' => '#f44336',
        '[[setting:editverticalpadding]]' => '',
        '[[setting:edithorizontalpadding]]' => '',
        '[[setting:edittopmargin]]' => '',
        '[[setting:editfont]]' => '#ffffff',
        '[[setting:sliderh3color]]' => '#ffffff',
        '[[setting:sliderh4color]]' => '#ffffff',
        '[[setting:slidersubmitbgcolor]]' => '#51666C',
        '[[setting:slidersubmitcolor]]' => '#ffffff',
        '[[setting:slider2h3color]]' => '#000000',
        '[[setting:slider2h4color]]' => '#000000',
        '[[setting:slider2h3bgcolor]]' => '#000000',
        '[[setting:slider2h4bgcolor]]' => '#ffffff',
        '[[setting:slideroption2color]]' => '#51666C',
        '[[setting:slideroption2submitcolor]]' => '#ffffff',
        '[[setting:slideroption2a]]' => '#51666C',
        '[[setting:socialsize]]' => '37px',
        '[[setting:mobile]]' => '22',
        '[[setting:socialpaddingside]]' => 16,
        '[[setting:socialpaddingtop]]' => '0%',
        '[[setting:fontname]]' => 'Open Sans',
        '[[setting:fontsize]]' => '95%',
        '[[setting:fontheadername]]' => 'Roboto',
        '[[setting:fontcolor]]' => '#333333',
        '[[setting:fontheadercolor]]' => '#333333',
        '[[setting:fontweight]]' => '400',
        '[[setting:fontheaderweight]]' => '400',
        '[[setting:fonttitlename]]' => 'Roboto Condensed',
        '[[setting:fonttitleweight]]' => '400',
        '[[setting:fonttitlesize]]' => '48px',
        '[[setting:fonttitlecolor]]' => '#ffffff',
        '[[setting:fonttitlecolorcourse]]' => '#ffffff',
        '[[setting:customfontname]]' => '',
        '[[setting:customfontheadername]]' => '',
        '[[setting:customfonttitlename]]' => '',
        '[[setting:sitetitlepadding]]' => '0px 0px 15px 0px',
        '[[setting:searchboxpadding]]' => '0px 0px 10px 0px',
        '[[setting:enablesavecanceloverlay]]' => true,
        '[[setting:pageheaderheight]]' => '72px',
        '[[setting:emoticonsize]]' => '16px',
        '[[setting:fullscreenwidth]]' => '98%',
        '[[setting:coursetitlemaxwidth]]' => '20',
        '[[setting:sitetitlemaxwidth]]' => '50%',
        '[[setting:responsivealerts]]' => 'd-none d-lg-block',
        '[[setting:responsiveheader]]' => 'd-none d-lg-block',
        '[[setting:responsivesocial]]' => 'd-none d-lg-block',
        '[[setting:responsivesocialsize]]' => '34px',
        '[[setting:responsivelogo]]' => 'd-none d-lg-block',
        '[[setting:responsivecoursetitle]]' => 'd-none d-lg-block',
        '[[setting:responsivesectionnav]]' => '1',
        '[[setting:responsivesearchicon]]' => true,
        '[[setting:responsiveticker]]' => 'd-none d-lg-block',
        '[[setting:responsivebreadcrumb]]' => 'd-none d-md-flex',
        '[[setting:responsiveslider]]' => 'd-none d-lg-block',
        '[[setting:responsivepagefooter]]' => 'd-none d-lg-block',
        '[[setting:hidefootersocial]]' => 1,
        '[[setting:enableavailablecourses]]' => 'display',
        '[[setting:enableticker]]' => true,
        '[[setting:enabletickermy]]' => true,
        '[[setting:tickerwidth]]' => '',
        '[[setting:socialwallbackgroundcolor]]' => '#FFFFFF',
        '[[setting:socialwallsectionradius]]' => '6px',
        '[[setting:socialwallbordertopstyle]]' => 'solid',
        '[[setting:socialwallborderwidth]]' => '2px',
        '[[setting:socialwallbordercolor]]' => '#B9B9B9',
        '[[setting:socialwallactionlinkcolor]]' => '#51666C',
        '[[setting:socialwallactionlinkhovercolor]]' => '#009688',
        '[[setting:fontblockheaderweight]]' => '400',
        '[[setting:fontblockheadersize]]' => '22px',
        '[[setting:fontblockheadercolor]]' => '#3A454b',
        '[[setting:blockiconsheadersize]]' => '20px',
        '[[setting:alertcolorinfo]]' => '#3a87ad',
        '[[setting:alertbackgroundcolorinfo]]' => '#d9edf7',
        '[[setting:alertbordercolorinfo]]' => '#bce8f1',
        '[[setting:alertcolorsuccess]]' => '#468847',
        '[[setting:alertbackgroundcolorsuccess]]' => '#dff0d8',
        '[[setting:alertbordercolorsuccess]]' => '#d6e9c6',
        '[[setting:alertcolorwarning]]' => '#8a6d3b',
        '[[setting:alertbackgroundcolorwarning]]' => '#fcf8e3',
        '[[setting:alertbordercolorwarning]]' => '#fbeed5',
        '[[setting:forumheaderbackgroundcolor]]' => '#ffffff',
        '[[setting:forumbodybackgroundcolor]]' => '#ffffff',
        '[[setting:introboxbackgroundcolor]]' => '#ffffff',
        '[[setting:showyourprogress]]' => '',
        '[[setting:tabbedlayoutdashboardcolorselected]]' => '#06c',
        '[[setting:tabbedlayoutdashboardcolorunselected]]' => '#eee',
        '[[setting:tabbedlayoutcoursepagetabcolorselected]]' => '#06c',
        '[[setting:tabbedlayoutcoursepagetabcolorunselected]]' => '#eee',
        '[[setting:frontpagenumbertiles]]' => '4',
        '[[setting:sidebarnotlogged]]' => 'true',
        '[[setting:gdprbutton]]' => 1,
        '[[setting:infoiconcolor]]' => '#5bc0de',
        '[[setting:dangericoncolor]]' => '#d9534f',
        '[[setting:loginheader]]' => 1,
        '[[setting:loginfooter]]' => 1
    );

    // Get all the defined settings for the theme and replace defaults.
    foreach ($theme->settings as $key => $val) {
        if (array_key_exists('[[setting:'.$key.']]', $defaults) && !empty($val)) {
            $defaults['[[setting:'.$key.']]'] = $val;
        }
    }

    $homebkg = '';
    if (!empty($theme->settings->homebk)) {
        $homebkg = $theme->setting_file_url('homebk', 'homebk');
        $homebkg = 'background-image: url("' . $homebkg . '");';
    }
    $defaults['[[setting:homebkg]]'] = $homebkg;

    $loginbgimage = '';
    if (!empty($theme->settings->loginbgimage)) {
        $loginbgimage = $theme->setting_file_url('loginbgimage', 'loginbgimage');
        $loginbgimage = 'background-image: url("' . $loginbgimage . '");';
    }
    $defaults['[[setting:loginbgimage]]'] = $loginbgimage;

    $loginbgstyle = '';
    if (!empty($theme->settings->loginbgstyle)) {
        $replacementstyle = 'cover';
        if ($theme->settings->loginbgstyle === 'stretch') {
            $replacementstyle = '100% 100%';
        }
        $loginbgstyle = 'background-size: ' . $replacementstyle . ';';
    }
    $defaults['[[setting:loginbgstyle]]'] = $loginbgstyle;

    $loginbgopacity = '';
    if (!empty($theme->settings->loginbgopacity)) {
            $loginbgopacity = '#page-login-index header {'.PHP_EOL;
            $loginbgopacity .= 'background-color: '.\theme_adaptable\toolbox::hex2rgba($theme->settings->headerbkcolor2,
                               $theme->settings->loginbgopacity).') !important;'.PHP_EOL;
            $loginbgopacity .= '}'.PHP_EOL;
            $loginbgopacity .= '#page-login-index #page-navbar,'.PHP_EOL.
            '#page-login-index .card {';
            $loginbgopacity .= 'background-color: rgba(255, 255, 255, '.$theme->settings->loginbgopacity.') !important;'.PHP_EOL;
            $loginbgopacity .= '}'.PHP_EOL;
            $loginbgopacity .= '#page-login-index #page-footer {'.PHP_EOL;
            $loginbgopacity .= 'background-color: '.\theme_adaptable\toolbox::hex2rgba($theme->settings->footerbkcolor,
                               $theme->settings->loginbgopacity).') !important;'.PHP_EOL;
            $loginbgopacity .= '}'.PHP_EOL;
    }
    $defaults['[[setting:loginbgopacity]]'] = $loginbgopacity;

    $socialpaddingsidehalf = '16';
    if (!empty($theme->settings->socialpaddingside)) {
        $socialpaddingsidehalf = ''.$theme->settings->socialpaddingside / 2;
    }
    $defaults['[[setting:socialpaddingsidehalf]]'] = $socialpaddingsidehalf;

    // Replace the CSS with values from the $defaults array.
    $css = strtr($css, $defaults);
    if (empty($theme->settings->tilesshowallcontacts) || $theme->settings->tilesshowallcontacts == false) {
        $css = theme_adaptable_set_tilesshowallcontacts($css, false);
    } else {
        $css = theme_adaptable_set_tilesshowallcontacts($css, true);
    }
    return $css;
}

/**
 * Adds any category custom CSS to the CSS before it is cached.
 *
 * @param string $css The original CSS.
 * @param array $settings Theme settings.
 * @return string The CSS which now contains our custom CSS.
 */
function theme_adaptable_set_categorycustomcss($css, $settings) {
    $tohavecustomheader = $settings->categoryhavecustomheader;
    $replacement = '';
    if (!empty($tohavecustomheader)) {
        $customheaderids = explode(',', $tohavecustomheader);
        $topcats = \theme_adaptable\toolbox::get_top_categories_with_children();
        $scss = new core_scss();
        $categoryscss = '';
        foreach ($customheaderids as $customheaderid) {
            $categoryheadercustomcssset = 'categoryheadercustomcss'.$customheaderid;
            if (!empty($settings->$categoryheadercustomcssset)) {
                // Validate and add if ok.
                try {
                    $scss->compile($settings->$categoryheadercustomcssset);

                    $catids = array($customheaderid);
                    $catinfo = $topcats[$customheaderid];
                    if (!empty($catinfo['children'])) {
                        // Child categories.
                        $catids = array_merge($catids, array_keys($catinfo['children']));
                    }
                    $categoryids = array();
                    foreach ($catids as $catid) {
                        $categoryids[] = '.category-'.$catid;
                    }
                    $categoryselector = implode(', ', $categoryids);
                    $categoryscss .= $categoryselector.'{'.PHP_EOL;
                    $categoryscss .= $settings->$categoryheadercustomcssset;
                    $categoryscss .= PHP_EOL.'}'.PHP_EOL;
                } catch (Leafo\ScssPhp\Exception\ParserException $e) {
                    debugging(get_string('invalidcategorycss', 'theme_adaptable',
                                array('css' => $settings->$categoryheadercustomcssset,
                                'topcatname' => $catinfo['name'], 'topcatid' => $customheaderid)), DEBUG_NONE);
                } catch (Leafo\ScssPhp\Exception\CompilerException $e) {
                    debugging(get_string('invalidcategorycss', 'theme_adaptable',
                                array('css' => $settings->$categoryheadercustomcssset,
                                'topcatname' => $catinfo['name'], 'topcatid' => $customheaderid)), DEBUG_NONE);
                }
            }
        }

        if (!empty($categoryscss)) {
            try {
                $replacement = $scss->compile($categoryscss);
            } catch (Leafo\ScssPhp\Exception\ParserException $e) {
                debugging(get_string('invalidcategorygeneratedcss', 'theme_adaptable', array('css' => $categoryscss)), DEBUG_NONE);
            } catch (Leafo\ScssPhp\Exception\CompilerException $e) {
                debugging(get_string('invalidcategorygeneratedcss', 'theme_adaptable', array('css' => $categoryscss)), DEBUG_NONE);
            }
        }
    }

    $tag = '[[setting:catgorycustomcss]]';

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Adds any custom CSS to the CSS before it is cached.
 *
 * @param string $css The original CSS.
 * @param string $customcss The custom CSS to add.
 * @return string The CSS which now contains our custom CSS.
 */
function theme_adaptable_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Set display of course contacts on front page tiles
 * @param string $css
 * @param string $display
 * @return $string
 */
function theme_adaptable_set_tilesshowallcontacts($css, $display) {
    $tag = '[[setting:tilesshowallcontacts]]';
    if ($display) {
        $replacement = 'block';
    } else {
        $replacement = 'none';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Get the user preference for the zoom (show / hide block) function.
 */
function theme_adaptable_get_zoom() {
    return get_user_preferences('theme_adaptable_zoom', '');
}

/**
 * Set user preferences for zoom (show / hide block) function
 * @param moodle_page $page
 * @return void
 */
function theme_adaptable_initialise_zoom(moodle_page $page) {
    user_preference_allow_ajax_update('theme_adaptable_zoom', PARAM_TEXT);
}

/**
 * Set the user preference for full screen
 * @param moodle_page $page
 * @return void
 */
function theme_adaptable_initialise_full(moodle_page $page) {
    if (theme_adaptable_get_setting('enablezoom')) {
        user_preference_allow_ajax_update('theme_adaptable_full', PARAM_TEXT);
    }
}

/**
 * Get the user preference for the zoom function.
 */
function theme_adaptable_get_full() {
    $fullpref = '';
    if ((isloggedin()) && (theme_adaptable_get_setting('enablezoom'))) {
        $fullpref = get_user_preferences('theme_adaptable_full', '');
    }

    if (empty($fullpref)) { // Zoom disabled, not logged in or user not chosen preference.
        $defaultzoom = theme_adaptable_get_setting('defaultzoom');
        if (empty($defaultzoom)) {
            $defaultzoom = 'normal';
        }
        if ($defaultzoom == 'normal') {
            $fullpref = 'nofull';
        } else {
            $fullpref = 'fullin';
        }
    }

    return $fullpref;
}

/**
 * Get the key of the last closed alert for a specific alert index.
 * This will be used in the renderer to decide whether to include the alert or not
 * @param int $alertindex
 */
function theme_adaptable_get_alertkey($alertindex) {
    user_preference_allow_ajax_update('theme_adaptable_alertkey' . $alertindex, PARAM_TEXT);
    return get_user_preferences('theme_adaptable_alertkey' . $alertindex, '');
}

/**
 * Get HTML for settings
 * @param renderer_base $output
 * @param moodle_page $page
 */
function theme_adaptable_get_html_for_settings(renderer_base $output, moodle_page $page) {
    global $CFG;
    $return = new stdClass;

    $return->navbarclass = '';
    if (!empty($page->theme->settings->invert)) {
        $return->navbarclass .= ' navbar-inverse';
    }

    if (!empty($page->theme->settings->logo)) {
        $return->heading = html_writer::link($CFG->wwwroot, '', array('title' => get_string('home'), 'class' => 'logo'));
    } else {
        $return->heading = $output->page_heading();
    }

    $return->footnote = '';
    if (!empty($page->theme->settings->footnote)) {
        $return->footnote = '<div class="footnote">'.$page->theme->settings->footnote.'</div>';
    }

    return $return;
}

/**
 * Get theme setting
 * @param string $setting
 * @param string $format = false
 */
function theme_adaptable_get_setting($setting, $format = false) {
    static $theme;
    if (empty($theme)) {
        $theme = theme_config::load('adaptable');
    }

    if (empty($theme->settings->$setting)) {
        return false;
    } else if (!$format) {
        return $theme->settings->$setting;
    } else if ($format === 'format_text') {
        return format_text($theme->settings->$setting, FORMAT_PLAIN);
    } else if ($format === 'format_html') {
        return format_text($theme->settings->$setting, FORMAT_HTML, array('trusted' => true));
    } else {
        return format_string($theme->settings->$setting);
    }
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function theme_adaptable_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    static $theme;
    if (empty($theme)) {
        $theme = theme_config::load('adaptable');
    }
    if ($context->contextlevel == CONTEXT_SYSTEM) {
        // By default, theme files must be cache-able by both browsers and proxies.  From 'More' theme.
        if (!array_key_exists('cacheability', $options)) {
            $options['cacheability'] = 'public';
        }
        if ($filearea === 'logo') {
            return $theme->setting_file_serve('logo', $args, $forcedownload, $options);
        } else if ($filearea === 'favicon') {
            return $theme->setting_file_serve('favicon', $args, $forcedownload, $options);
        } else if ($filearea === 'homebk') {
            return $theme->setting_file_serve('homebk', $args, $forcedownload, $options);
        } else if ($filearea === 'pagebackground') {
            return $theme->setting_file_serve('pagebackground', $args, $forcedownload, $options);
        } else if (preg_match("/^p[1-9][0-9]?$/", $filearea) !== false) {
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else if ((substr($filearea, 0, 9) === 'marketing') && (substr($filearea, 10, 5) === 'image')) {
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else if (preg_match("/^categoryheaderbgimage[1-9][0-9]*$/", $filearea) !== false) { // Link: http://regexpal.com/ useful.
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else if (preg_match("/^categoryheaderlogo[1-9][0-9]*$/", $filearea) !== false) { // Link: http://regexpal.com/ useful.
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else if ($filearea === 'iphoneicon') {
            return $theme->setting_file_serve('iphoneicon', $args, $forcedownload, $options);
        } else if ($filearea === 'iphoneretinaicon') {
            return $theme->setting_file_serve('iphoneretinaicon', $args, $forcedownload, $options);
        } else if ($filearea === 'ipadicon') {
            return $theme->setting_file_serve('ipadicon', $args, $forcedownload, $options);
        } else if ($filearea === 'ipadretinaicon') {
            return $theme->setting_file_serve('ipadretinaicon', $args, $forcedownload, $options);
        } else if ($filearea === 'fontfilettfheading') {
            return $theme->setting_file_serve('fontfilettfheading', $args, $forcedownload, $options);
        } else if ($filearea === 'fontfilettfbody') {
            return $theme->setting_file_serve('fontfilettfbody', $args, $forcedownload, $options);
        } else if ($filearea === 'adaptablemarkettingimages') {
            return $theme->setting_file_serve('adaptablemarkettingimages', $args, $forcedownload, $options);
        } else {
            send_file_not_found();
        }
    } else {
        send_file_not_found();
    }
}

/**
 * Get course activities for this course menu
 */
function theme_adaptable_get_course_activities() {
    GLOBAL $CFG, $PAGE, $OUTPUT;
    // A copy of block_activity_modules.
    $course = $PAGE->course;
    $content = new stdClass();
    $modinfo = get_fast_modinfo($course);
    $modfullnames = array();

    $archetypes = array();

    foreach ($modinfo->cms as $cm) {
        // Exclude activities which are not visible or have no link (=label).
        if (!$cm->uservisible or !$cm->has_view()) {
            continue;
        }
        if (array_key_exists($cm->modname, $modfullnames)) {
            continue;
        }
        if (!array_key_exists($cm->modname, $archetypes)) {
            $archetypes[$cm->modname] = plugin_supports('mod', $cm->modname, FEATURE_MOD_ARCHETYPE, MOD_ARCHETYPE_OTHER);
        }
        if ($archetypes[$cm->modname] == MOD_ARCHETYPE_RESOURCE) {
            if (!array_key_exists('resources', $modfullnames)) {
                $modfullnames['resources'] = get_string('resources');
            }
        } else {
            $modfullnames[$cm->modname] = $cm->modplural;
        }
    }
    core_collator::asort($modfullnames);

    return $modfullnames;
}

/**
 * Get formatted performance info showing only page load time
 * @param string $param
 */
function theme_adaptable_performance_output($param) {
    $html = html_writer::tag('span', get_string('loadtime', 'theme_adaptable').' '. round($param['realtime'], 2) . ' ' .
            get_string('seconds'), array('id' => 'load'));
    return $html;
}

/**
 * Initialize page
 * @param moodle_page $page
 */
function theme_adaptable_page_init(moodle_page $page) {
    global $CFG;

    $page->requires->jquery_plugin('pace', 'theme_adaptable');
    $page->requires->jquery_plugin('flexslider', 'theme_adaptable');
    $page->requires->jquery_plugin('ticker', 'theme_adaptable');
    $page->requires->jquery_plugin('easing', 'theme_adaptable');
    $page->requires->jquery_plugin('adaptable', 'theme_adaptable');

}

/**
 * Strip full site title from header
 * @param string $heading
 */
function theme_adaptable_remove_site_fullname($heading) {
    global $SITE, $PAGE;
    if (strpos($PAGE->pagetype, 'course-view-') === 0) {
        return $heading;
    }

    $header = preg_replace("/^".$SITE->fullname."/", "", $heading);

    return $header;
}

/**
 * Generate theme grid.
 * @param bool $left
 * @param bool $hassidepost
 */
function theme_adaptable_grid($left, $hassidepost) {
    if ($hassidepost) {
        if ('rtl' === get_string('thisdirection', 'langconfig')) {
            $left = !$left; // Invert.
        }
        $regions = array('content' => 'col-9');
        $regions['blocks'] = 'col-3';
        if ($left) {
            $regions['direction'] = ' flex-row-reverse';
        } else {
            $regions['direction'] = '';
        }
    } else {
        $regions = array('content' => 'col-12');
        $regions['direction'] = '';
        return $regions;
    }

    return $regions;
}

/**
 *
 * Get the current page to allow us to check if the block is allowed to display.
 *
 * @return string The page name, which is either "frontpage", "dashboard", "coursepage", "coursesectionpage" or empty string.
 *
 */
function theme_adaptable_get_current_page() {
    global $COURSE, $PAGE;

    // This will store the kind of activity page type we find. E.g. It will get populated with 'section' or similar.
    $currentpage = '';

    // We expect $PAGE->url to exist.  It should!
    $url = $PAGE->url;

    if ($PAGE->pagetype == 'site-index') {
        $currentpage = 'frontpage';
    } else if ($PAGE->pagetype == 'my-index') {
        $currentpage = 'dashboard';
    }
    // Check if course home page.
    if (empty ($currentpage)) {
        if ($url !== null) {
            // Check if this is the course view page.
            if (strstr ($url->raw_out(), 'course/view.php')) {

                $currentpage = 'coursepage';

                // Get raw querystring params from URL.
                $getparams = http_build_query($_GET);

                // Check url paramaters.  Count should be 1 if course home page. Use this to check if section page.
                $urlparams = $url->params();

                // Allow the block to display on course sections too if the relevant setting is on.
                if ((count ($urlparams) > 1) && (array_key_exists('section', $urlparams))) {
                    $currentpage = 'coursesectionpage';
                }

            }
        }
    }

    return $currentpage;
}
