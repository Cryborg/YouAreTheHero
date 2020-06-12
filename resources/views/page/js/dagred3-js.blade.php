var inputGraph = document.querySelector("#inputGraph");

var oldInputGraphValue;

var debugAlignmentRE = /[?&]alignment=([^&]+)/;
var debugAlignmentMatch = window.location.search.match(debugAlignmentRE);
var debugAlignment;
if (debugAlignmentMatch) debugAlignment = debugAlignmentMatch[1];

// Set up zoom support
var svg = d3.select("svg"),
    inner = d3.select("svg g"),
    zoom = d3.zoom().on("zoom", function () {
        inner.attr("transform", d3.event.transform);
    });
svg.call(zoom);

// Create and configure the renderer
var render = dagreD3.render();

var g;

function tryDraw(graphData) {
    if (graphData) {
        $('#inputGraph').val(graphData);
    }

    if (oldInputGraphValue !== inputGraph.value) {
        inputGraph.setAttribute("class", "");
        oldInputGraphValue = inputGraph.value;
        try {
            g = graphlibDot.read(inputGraph.value);
        } catch (e) {
            inputGraph.setAttribute("class", "error");
            throw e;
        }

        // Set margins, if not present
        if (!g.graph().hasOwnProperty("marginx") &&
            !g.graph().hasOwnProperty("marginy")) {
            g.graph().marginx = 20;
            g.graph().marginy = 20;
        }

        g.graph().transition = function (selection) {
            return selection.transition().duration(500);
        };

        // Render the graph into svg g
        d3.select("svg g").call(render, g);
    }
}
