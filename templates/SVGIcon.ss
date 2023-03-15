<{$wrapper} class="svg-icon svg-icon-{$Icon}">
    <svg>
        <% if $title %><title>$title</title><% end_if %>
        <use xlink:href="/{$resourcesDir}/{$icon_file}#{$Icon}"></use>
    </svg>
</{$wrapper}>
