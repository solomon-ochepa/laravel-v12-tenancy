<?php

if (! function_exists('route_path')) {
    /**
     * Get the file path of a route if it exists.
     *
     * Checks for the existence of a route file in the specified routes directory.
     * Returns the full file path if found, or null if the route file does not exist.
     *
     * @param  string  $route  The route file name (e.g., 'web.php', 'api.php').
     * @return string|null The file path if the route exists, null otherwise.
     */
    function route_path(string $route): ?string
    {
        return (file_exists($file = base_path("routes/{$route}"))) ? $file : null;
    }
}

if (! function_exists('module_route_path')) {
    /**
     * Get the file path of a module route if it exists.
     *
     * Checks for the existence of a route file in the specified module's routes directory.
     * Returns the full file path if found, or null if the route file does not exist.
     *
     * @param  string  $module  The name of the module.
     * @param  string  $route  The route file name (e.g., 'web.php', 'api.php').
     * @return string|null The file path if the route exists, null otherwise.
     */
    function module_route_path(string $module, string $route): ?string
    {
        return (file_exists($file = module_path($module, "routes/{$route}"))) ? $file : null;
    }
}

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
