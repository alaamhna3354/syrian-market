<?php

use App\Models\Language;
use \Illuminate\Support\Str;

function template($asset = false)
{
    $activeTheme = config('basic.theme');
    if ($asset) return 'assets/themes/' . $activeTheme . '/';
    return 'themes.' . $activeTheme . '.';
}


function recursive_array_replace($find, $replace, $array)
{
    if (!is_array($array)) {
        return str_replace($find, $replace, $array);
    }
    $newArray = [];
    foreach ($array as $key => $value) {
        $newArray[$key] = recursive_array_replace($find, $replace, $value);
    }
    return $newArray;
}

function menuActive($routeName, $type = null)
{
    $class = 'active';
    if ($type == 3) {
        $class = 'selected';
    } elseif ($type == 2) {
        $class = 'has-arrow active';
    } elseif ($type == 1) {
        $class = 'in';
    }
    if (is_array($routeName)) {
        foreach ($routeName as $key => $value) {
            if (request()->routeIs($value)) {
                return $class;
            }
        }
    } elseif (request()->routeIs($routeName)) {
        return $class;
    }
}


function getFile($image, $clean = '')
{
    return file_exists($image) && is_file($image) ? asset($image) . $clean : asset(config('location.default'));
}

function removeFile($path)
{
    return file_exists($path) && is_file($path) ? @unlink($path) : false;
}

function loopIndex($object)
{
    return ($object->currentPage() - 1) * $object->perPage() + 1;
}

function getAmount($amount, $length = 0)
{
    if (0 < $length) {
        return number_format($amount + 0, $length);
    }
    return $amount + 0;
}


function strRandom($length = 12)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function diffForHumans($date)
{
    $lang = session()->get('lang');
    \Carbon\Carbon::setlocale($lang);
    return \Carbon\Carbon::parse($date)->diffForHumans();
}

function dateTime($date, $format = 'd M, Y h:i A')
{
    return date($format, strtotime($date));
}

if (!function_exists('putPermanentEnv')) {
    function putPermanentEnv($key, $value)
    {
        $path = app()->environmentFilePath();
        $escaped = preg_quote('=' . env($key), '/');
        file_put_contents($path, preg_replace(
            "/^{$key}{$escaped}/m",
            "{$key}={$value}",
            file_get_contents($path)
        ));
    }
}

function checkTo($currencies, $selectedCurrency = 'USD')
{
    foreach ($currencies as $key => $currency) {
        if (property_exists($currency, strtoupper($selectedCurrency))) {
            return $key;
        }
    }
}

function code($length = 6)
{
    if ($length == 0) return 0;
    $min = pow(10, $length - 1);
    $max = 0;
    while ($length > 0 && $length--) {
        $max = ($max * 10) + 9;
    }
    return random_int($min, $max);
}

function invoice(){

    return time().code(4);
}

function wordTruncate($string, $offset = 0, $length = null): string
{
    $words = explode(" ", $string);
    isset($length) ? array_splice($words, $offset, $length) : array_splice($words, $offset);
    return implode(" ", $words);
}

function linkToEmbed($string)
{
    if (strpos($string, 'youtube') !== false) {
        $words = explode("/", $string);
        if (strpos($string, 'embed') == false) {
            array_splice($words, -1, 0, 'embed');
        }
        $words = str_ireplace('watch?v=', '', implode("/", $words));
        return $words;
    }
    return $string;
}


function slug($title)
{
    return \Illuminate\Support\Str::slug($title);
}

function title2snake($string)
{
    return Str::title(str_replace(' ', '_', $string));
}

function snake2Title($string)
{
    return Str::title(str_replace('_', ' ', $string));
}

function kebab2Title($string)
{
    return Str::title(str_replace('-', ' ', $string));
}

function getLevelUser($id)
{
    $ussss = new \App\Models\User();
    return $ussss->referralUsers([$id]);
}

function getPercent($total, $current)
{
    if ($current > 0 && $total > 0) {
        $percent = (($current * 100) / $total) ?: 0;
    } else {
        $percent = 0;
    }
    return round($percent, 0);
}

function flagLanguage($data)
{
    return  '{'.rtrim($data, ',').'}';
}

function getIpInfo()
{
    $ip = null;
    $deep_detect = TRUE;

    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $xml = @simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . $ip);

    $country = @$xml->geoplugin_countryName;
    $city = @$xml->geoplugin_city;
    $area = @$xml->geoplugin_areaCode;
    $code = @$xml->geoplugin_countryCode;
    $long = @$xml->geoplugin_longitude;
    $lat = @$xml->geoplugin_latitude;


    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $os_platform = "Unknown OS Platform";
    $os_array = array(
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );
    foreach ($os_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
        }
    }
    $browser = "Unknown Browser";
    $browser_array = array(
        '/msie/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/edge/i' => 'Edge',
        '/opera/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i' => 'Handheld Browser'
    );
    foreach ($browser_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $browser = $value;
        }
    }

    $data['country'] = $country;
    $data['city'] = $city;
    $data['area'] = $area;
    $data['code'] = $code;
    $data['long'] = $long;
    $data['lat'] = $lat;
    $data['os_platform'] = $os_platform;
    $data['browser'] = $browser;
    $data['ip'] = request()->ip();
    $data['time'] = date('d-m-Y h:i:s A');

    return $data;
}


function resourcePaginate($data,$callback){
    return $data->setCollection($data->getCollection()->map($callback));
}


function clean($string) {
    $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
function camelToWord($str) {
    $arr =  preg_split('/(?=[A-Z])/',$str);
    return trim(join(' ',$arr));
}

function getLanguges()
{
    $languages =  Language::where('is_active',1)->orderBy('short_name')->get();

    return $languages;
}

function get5SimCountries()
{
    $countries = [
        "afghanistan" => "Afghanistan",
        "albania" => "Albania",
        "algeria" => "Algeria",
        "angola" => "Angola",
        "anguilla" => "Anguilla",
        "antiguaandbarbuda" => "Antigua and Barbuda",
        "argentina" => "Argentina",
        "aruba" => "Aruba",
        "australia" => "Australia",
        "austria" => "Austria",
        "azerbaijan" => "Azerbaijan",
        "bahamas" => "Bahamas",
        "bahrain" => "Bahrain",
        "bangladesh" => "Bangladesh",
        "barbados" => "Barbados",
        "belarus" => "Belarus",
        "belgium" => "Belgium",
        "belize" => "Belize",
        "benin" => "Benin",
        "bih" => "Bosnia and Herzegovina",
        "bolivia" => "Bolivia",
        "botswana" => "Botswana",
        "brazil" => "Brazil",
        "bulgaria" => "Bulgaria",
        "burkinafaso" => "Burkina Faso",
        "burundi" => "Burundi",
        "cambodia" => "Cambodia",
        "cameroon" => "Cameroon",
        "canada" => "Canada",
        "capeverde" => "Cape Verde",
        "caymanislands" => "Cayman Islands",
        "chad" => "Chad",
        "chile" => "Chile",
        "china" => "China",
        "colombia" => "Colombia",
        "comoros" => "Comoros",
        "congo" => "Congo",
        "costarica" => "Costa Rica",
        "croatia" => "Croatia",
        "cyprus" => "Cyprus",
        "czech" => "Czechia",
        "djibouti" => "Djibouti",
        "dominica" => "Dominica",
        "dominicana" => "Dominican Republic",
        "easttimor" => "East Timor",
        "ecuador" => "Ecuador",
        "egypt" => "Egypt",
        "england" => "England",
        "equatorialguinea" => "Equatorial Guinea",
        "eritrea" => "Eritrea",
        "estonia" => "Estonia",
        "ethiopia" => "Ethiopia",
        "finland" => "Finland",
        "france" => "France",
        "frenchguiana" => "French Guiana",
        "gabon" => "Gabon",
        "gambia" => "Gambia",
        "georgia" => "Georgia",
        "germany" => "Germany",
        "ghana" => "Ghana",
        "greece" => "Greece",
        "grenada" => "Grenada",
        "guadeloupe" => "Guadeloupe",
        "guatemala" => "Guatemala",
        "guinea" => "Guinea",
        "guineabissau" => "Guinea-Bissau",
        "guyana" => "Guyana",
        "haiti" => "Haiti",
        "honduras" => "Honduras",
        "hongkong" => "Hong Kong",
        "hungary" => "Hungary",
        "india" => "India",
        "indonesia" => "Indonesia",
        "ireland" => "Ireland",
        "italy" => "Italy",
        "ivorycoast" => "Ivory Coast",
        "jamaica" => "Jamaica",
        "japan" => "Japan",
        "jordan" => "Jordan",
        "kazakhstan" => "Kazakhstan",
        "kenya" => "Kenya",
        "kuwait" => "Kuwait",
        "kyrgyzstan" => "Kyrgyzstan",
        "laos" => "Laos",
        "latvia" => "Latvia",
        "lesotho" => "Lesotho",
        "liberia" => "Liberia",
        "lithuania" => "Lithuania",
        "luxembourg" => "Luxembourg",
        "macau" => "Macau",
        "madagascar" => "Madagascar",
        "malawi" => "Malawi",
        "malaysia" => "Malaysia",
        "maldives" => "Maldives",
        "mauritania" => "Mauritania",
        "mauritius" => "Mauritius",
        "mexico" => "Mexico",
        "moldova" => "Moldova",
        "mongolia" => "Mongolia",
        "montenegro" => "Montenegro",
        "montserrat" => "Montserrat",
        "morocco" => "Morocco",
        "mozambique" => "Mozambique",
        "myanmar" => "Myanmar",
        "namibia" => "Namibia",
        "nepal" => "Nepal",
        "netherlands" => "Netherlands",
        "newcaledonia" => "New Caledonia",
        "newzealand" => "New Zealand",
        "nicaragua" => "Nicaragua",
        "niger" => "Niger",
        "nigeria" => "Nigeria",
        "northmacedonia" => "North Macedonia",
        "norway" => "Norway",
        "oman" => "Oman",
        "pakistan" => "Pakistan",
        "panama" => "Panama",
        "papuanewguinea" => "Papua New Guinea",
        "paraguay" => "Paraguay",
        "peru" => "Peru",
        "philippines" => "Philippines",
        "poland" => "Poland",
        "portugal" => "Portugal",
        "puertorico" => "Puertorico",
        "reunion" => "Reunion",
        "romania" => "Romania",
        "russia" => "Russia",
        "rwanda" => "Rwanda",
        "saintkittsandnevis" =>"Saint Kitts and Nevis",
        "saintlucia" => "Saint Lucia",
        "saintvincentandgrenadines" => "Saint Vincent and the Grenadines",
        "salvador" => "Salvador",
        "samoa" => "Samoa",
        "saotomeandprincipe" => "Sao Tome and Principe",
        "audiarabia" => "Saudi Arabia",
        "senegal" => "Senegal",
        "serbia" => "Serbia",
        "seychelles" => "Republic of Seychelles",
        "sierraleone" => "Sierra Leone",
        "singapore" => "Singapore",
        "slovakia" => "Slovakia",
        "slovenia" => "Slovenia",
        "solomonislands" => "Solomon Islands",
        "southafrica" => "South Africa",
        "spain" => "Spain",
        "srilanka" => "Sri Lanka",
        "suriname" => "Suriname",
        "swaziland" => "Swaziland",
        "sweden" => "Sweden",
        "switzerland" => "Switzerland",
        "taiwan" => "Taiwan",
        "tajikistan" => "Tajikistan",
        "tanzania" => "Tanzania",
        "tit" => "Trinidad and Tobago",
        "togo" => "Togo",
        "tonga" => "Tonga",
        "tunisia" => "Tunisia",
        "turkey" => "Turkey",
        "turkmenistan" => "Turkmenistan",
        "turksandcaicos" => "Turks and Caicos Island",
        "uganda" => "Uganda",
        "ukraine" => "Ukraine",
        "uruguay" => "Uruguay",
        "usa" => "USA",
        "uzbekistan" => "Uzbekistan",
        "venezuela" => "Venezuela",
        "vietnam" => "Vietnam",
        "virginislands" => "British Virgin Islands",
        "zambia" => "Zambia",
        "zimbabwe" => "Zimbabwe"

    ];
    return $countries;
}

function get5SimProducts()
{
    $products = [
        "airtel",
        "alfa",
        "bigolive",
        "cryptocom",
        "delivery",
        "facebook",
        "fiqsy",
        "fiverr",
        "foodpanda",
        "foody",
        "forwarding",
        "freecharge",
        "galaxy",
        "gamearena",
        "gameflip",
        "gamekit",
        "gamer",
        "gcash",
        "get",
        "getir",
        "gett",
        "gg",
        "gittigidiyor",
        "global24",
        "globaltel",
        "globus",
        "glovo",
        "google",
        "grabtaxi",
        "green",
        "grindr",
        "hamrahaval",
        "happn",
        "haraj",
        "hepsiburadacom",
        "hezzl",
        "hily",
        "hopi",
        "hqtrivia",
        "humblebundle",
        "humta",
        "huya",
        "icard",
        "icq",
        "icrypex",
        "ifood",
        "immowelt",
        "imo",
        "inboxlv",
        "indriver",
        "ininal",
        "instagram",
        "iost",
        "iqos",
        "ivi",
        "iyc",
        "jd",
        "jkf",
        "justdating",
        "justdial",
        "kakaotalk",
        "karusel",
        "keybase",
        "komandacard",
        "kotak811",
        "kucoinplay",
        "kufarby",
        "kvartplata",
        "kwai",
        "lazada",
        "lbry",
        "lenta",
        "lianxin",
        "line",
        "linkedin",
        "livescore",
        "magnit",
        "magnolia",
        "mailru",
        "mamba",
        "mcdonalds",
        "meetme",
        "mega",
        "mercado",
        "michat",
        "microsoft",
        "miloan",
        "miratorg",
        "mobile01",
        "momo",
        "monese",
        "monobank",
        "mosru",
        "mrgreen",
        "mtscashback",
        "myfishka",
        "myglo",
        "mylove",
        "mymusictaste",
        "mzadqatar",
        "nana",
        "naver",
        "ncsoft",
        "netflix",
        "nhseven",
        "nifty",
        "nike",
        "nimses",
        "nrjmusicawards",
        "nttgame",
        "odnoklassniki",
        "offerup",
        "offgamers",
        "okcupid",
        "okey",
        "okta",
        "olacabs",
        "olx",
        "onlinerby",
        "openpoint",
        "oraclecloud",
        "oriflame",
        "other",
        "ozon",
        "paddypower",
        "pairs",
        "papara",
        "paxful",
        "payberry",
        "paycell",
        "paymaya",
        "paypal",
        "paysend",
        "paytm",
        "peoplecom",
        "perekrestok",
        "pgbonus",
        "picpay",
        "pof",
        "pokec",
        "pokermaster",
        "potato",
        "powerkredite",
        "prajmeriz2020",
        "premiumone",
        "prom",
        "proton",
        "protonmail",
        "protp",
        "pubg",
        "pureplatfrom",
        "pyaterochka",
        "pyromusic",
        "q12trivia",
        "qiwiwallet",
        "quipp",
        "rakuten",
        "rambler",
        "rediffmail",
        "reuse",
        "ripkord",
        "rosakhutor",
        "rsa",
        "rutube",
        "samokat",
        "seosprint",
        "sheerid",
        "shopee",
        "signal",
        "sikayetvar",
        "skout",
        "snapchat",
        "snappfood",
        "sneakersnstuff",
        "socios",
        "sportmaster",
        "spothit",
        "ssoidnet",
        "steam",
        "surveytime",
        "swvl",
        "taksheel",
        "tango",
        "tantan",
        "taobao",
        "telegram",
        "tencentqq",
        "ticketmaster",
        "tiktok",
        "tinder",
        "tosla",
        "totalcoin",
        "touchance",
        "trendyol",
        "truecaller",
        "twitch",
        "twitter",
        "uber",
        "ukrnet",
        "uploaded",
        "vernyi",
        "vernyj",
        "viber",
        "vitajekspress",
        "vkontakte",
        "voopee",
        "wechat",
        "weibo",
        "weku",
        "weststein",
        "whatsapp",
        "wildberries",
        "wingmoney",
        "winston",
        "wish",
        "wmaraci",
        "wolt",
        "yaay",
        "yahoo",
        "yalla",
        "yandex",
        "yemeksepeti",
        "youdo",
        "youla",
        "youstar",
        "zalo",
        "zoho",
        "zomato",
    ];

    return $products;
}