// Create the input graph
var g = new dagreD3.graphlib.Graph()
    .setGraph({})
    .setDefaultEdgeLabel(function() { return {}; });

// Here we're setting nodeclass, which is used by our custom drawNodes function
// below.
@foreach ($pages as $page)
    g.setNode({{ $page->id }},  {
        labelType: "html",
        label: '<a href="{{ route('page.edit', ['page' => $page->id]) }}">{{ $page->title }}</a>',
{{--        label: he.decode("{{ $page->title }}"),--}}
        class: "align-middle text-center",
        labelStyle: "margin-top: 4px;"
    });
@endforeach

g.nodes().forEach(function(v) {
    var node = g.node(v);
    // Round the corners of the nodes
    node.rx = node.ry = 5;
});

// Set up edges
@foreach ($pages as $page)
    @if ($page->choices()->count() > 0)
        @foreach ($page->choices as $choice)
            g.setEdge({{ $page->id }}, {{ $choice->id }}, {
                labelType: "html",
                label: '<span class="choice-text icon-fountain-pen text-white clickable border-right border-light p-1 mr-2" ' +
                    'data-choice-id="{{ $choice->pivot->id }}" ' +
                    'data-page-to="{{ $choice->id }}"></span>{{ $choice->pivot->link_text }}' +
                    '<span class="choice-text icon-trash clickable text-red border-left border-light p-1 ml-2" ' +
                    'data-page-from="{{ $page->id }}"></span>',
                labelStyle: "border: 1px solid white;color:white;background-color:black;padding:3px;font-size:.8em"
            });
        @endforeach
    @endif
@endforeach

// Create the renderer
var render = new dagreD3.render();

var svg = d3.select("svg"),
  inner = svg.select("g");

var zoom = d3.zoom().on("zoom", function() {
    inner.attr("transform", d3.event.transform);
});
svg.call(zoom)

// Run the renderer. This is what draws the final graph.
render(d3.select("svg g"), g);

