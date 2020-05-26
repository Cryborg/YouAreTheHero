// Create the input graph
var g = new dagreD3.graphlib.Graph()
    .setGraph({})
    .setDefaultEdgeLabel(function() { return {}; });

// Here we're setting nodeclass, which is used by our custom drawNodes function
// below.
@foreach ($pages as $page)
    g.setNode({{ $page->id }},  { label: he.decode("{{ $page->title }}"),       class: "{{ $page->id }} @if ($current->id === $page->id) active @endif" });
@endforeach

g.nodes().forEach(function(v) {
    var node = g.node(v);
    // Round the corners of the nodes
    node.rx = node.ry = 5;
});

// Set up edges, no special attributes.
@foreach ($pages as $page)
    @if ($page->choices()->count() > 0)
        @foreach ($page->choices as $choice)
            g.setEdge({{ $page->id }}, {{ $choice->id }});
        @endforeach
    @endif
@endforeach

// Create the renderer
var render = new dagreD3.render();

// Set up an SVG group so that we can translate the final graph.
var svg = d3.select("svg"),
    svgGroup = svg.append("g");

// Run the renderer. This is what draws the final graph.
render(d3.select("svg g"), g);

$(document).on('click', 'g.node', function () {
    var classes = $(this).prop("classList");

    window.location.href = route('page.edit', {'page': classes[1]});
});
