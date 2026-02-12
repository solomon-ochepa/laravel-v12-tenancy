<?php

if (! function_exists('domain')) {
    /**
     * Get the application domain with optional port.
     *
     * Constructs the full domain by parsing the app.url config, optionally appending
     * the port if it's non-standard (not 80). Useful for generating full URLs or
     * when needing consistent domain references throughout the application.
     *
     * Acceptance Criteria:
     * - Returns domain without port when standard HTTP port (80) is used
     * - Includes port number when non-standard port is configured
     * - Correctly handles URL parsing from config('app.url')
     *
     * @return string The application domain, with port if non-standard
     *
     * @example domain() // Returns 'example.com' or 'example.com:8080'
     */
    function domain()
    {
        $domain = parse_url(config('app.url'), PHP_URL_HOST);
        if (config('app.port', 80) !== 80) {
            $domain .= ':'.config('app.port');
        }

        return $domain;
    }
}
