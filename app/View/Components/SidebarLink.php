<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarLink extends Component
{
    /**
     * The route name for the link.
     *
     * @var string
     */
    public $route;

    /**
     * Text label for the link.
     *
     * @var string
     */
    public $label;

    /**
     * Raw SVG path(s) for the icon.
     *
     * @var string
     */
    public $icon;

    /**
     * Route pattern used to determine active state.
     *
     * @var string
     */
    public $pattern;

    /**
     * Optional HTML to show besides the link (e.g. "new" button).
     *
     * @var string|null
     */
    public $extra;

    /**
     * Create the component instance.
     *
     * @param string $route
     * @param string $label
     * @param string $icon
     * @param string $pattern
     * @param string|null $extra
     * @return void
     */
    public function __construct(string $route, string $label, string $icon, string $pattern, ?string $extra = null)
    {
        $this->route = $route;
        $this->label = $label;
        $this->icon = $icon;
        $this->pattern = $pattern;
        $this->extra = $extra;
    }

    /**
     * Determine if this link is currently active.
     *
     * @return bool
     */
    public function isActive()
    {
        return request()->routeIs($this->pattern);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.sidebar-link');
    }
}
