/**
 * Redirect any URL matching the regex
 * 
 * @param string $pattern The regex to match
 * @param string $replacement The path to redirect to
 * @param boolean $case_sensitive If should ignore case
 */
function k_redirect($pattern, $replacement, $case_sensitive = false) {

    //if this is the command line, don't redirect
    if (php_sapi_name() == "cli") {
        return;
    }

    //always filter inputs
    $current_URL_path = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);

    //set the flag to i to ignore case, unless true passed in for $case_sensitive param
    $flags = i;

    if ($case_sensitive) {
        $flags = '';
    }


    $new_url = preg_replace('~' . $pattern . '~' . $flags, $replacement, $current_URL_path);

    //if no match don't redirect
    if ($new_url === $current_URL_path) {
        return;
    }

    header('HTTP/1.0 301 Moved Permanently');
    header('Location: ' . $new_url);
    exit();

    //Name transaction "redirect" in New Relic for improved reporting (optional)
    if (extension_loaded('newrelic')) {
        newrelic_name_transaction("redirect");
    }
}
