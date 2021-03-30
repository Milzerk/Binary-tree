  
  // ************** Generate the tree diagram	 *****************
  
var tree;
var root;
var i = 0,
    duration = 750;
var svg;
var  diagonal;
$('#buttonRandom').click(function() {
    var number = $("#newNumber").val();

    if(number == "") {
        return;
    }
    var cont = 0;
    var numbers = new Array();
    while(cont < parseInt(number)) {
        var random = Math.floor(Math.random() * parseInt(number))
        numbers.push(random);
        cont++;
    }

    $("#arrNumbers").val(JSON.stringify(numbers));

    submitTree(numbers);
});

$('#buttonAdd').click(function() {
    var number = $("#newNumber").val();
    if(number == "") {
        return;
    }
    var arrNumber = $("#arrNumbers").val();
    if(arrNumber == "") {
        numbers = [parseInt(number)]
    } else {
        numbers = JSON.parse(arrNumber);
        numbers.push(parseInt(number));
    }
    $("#arrNumbers").val(JSON.stringify(numbers));

    submitTree(numbers);
});

$('#buttonNew').click(function () {
    var arrNumber = $("#arrNumbers").val();
    if(arrNumber == "") {
        return;
    } else {
        numbers = JSON.parse(arrNumber);
    }

    submitTree(numbers);
});

function submitTree(dados) {

    $("#main-svg").remove();
    $.ajax({
        type: 'POST',
        url: "generateTree.php",
        data: { newNumber: dados},
        success: function (data) {
            var obj = JSON.parse(data);
            createTree(obj.tree);
            console.log(data);
        },
        error: function (){
            console.log('error');
        }
    });
}

function createTree(data) {
    var treeData = data;

  var margin = {top: 20, right: 120, bottom: 20, left: 120},
      width = 960 - margin.right - margin.left,
      height = 500 - margin.top - margin.bottom;
      
  
  tree = d3.layout.tree()
      .size([height, width]);
  
  diagonal = d3.svg.diagonal()
      .projection(function(d) { return [d.y, d.x]; });
  
  svg = d3.select(".container").append("svg")
      .attr("id", "main-svg")  
      .attr("width", width + margin.right + margin.left)
      .attr("height", 1000)
    .append("g")
      .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
  
  root = treeData[0];
  root.x0 = height / 2;
  root.y0 = 0;
  update(root);
  
  d3.select(self.frameElement).style("height", "500px");
};
 

function update(source) {

    // Compute the new tree layout.
    var nodes = tree.nodes(root).reverse(),
        links = tree.links(nodes);
  
    // Normalize for fixed-depth.
    nodes.forEach(function(d) { d.y = d.depth * 180; });
  
    // Update the nodes…
    var node = svg.selectAll("g.node")
        .data(nodes, function(d) { return d.id || (d.id = ++i); });
  
    // Enter any new nodes at the parent's previous position.
    var nodeEnter = node.enter().append("g")
        .attr("class", "node")
        .attr("transform", function(d) { return "translate(" + source.y0 + "," + source.x0 + ")"; })
        .on("click", click);
  
    nodeEnter.append("circle")
        .attr("r", 1e-6)
        .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });
  
    nodeEnter.append("text")
        .attr("x", function(d) { return d.children || d._children ? -13 : 13; })
        .attr("dy", ".35em")
        .attr("text-anchor", function(d) { return d.children || d._children ? "end" : "start"; })
        .text(function(d) { return d.name; })
        .style("fill-opacity", 1e-6);
  
    // Transition nodes to their new position.
    var nodeUpdate = node.transition()
        .duration(duration)
        .attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; });
  
    nodeUpdate.select("circle")
        .attr("r", 10)
        .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });
  
    nodeUpdate.select("text")
        .style("fill-opacity", 1);
  
    // Transition exiting nodes to the parent's new position.
    var nodeExit = node.exit().transition()
        .duration(duration)
        .attr("transform", function(d) { return "translate(" + source.y + "," + source.x + ")"; })
        .remove();
  
    nodeExit.select("circle")
        .attr("r", 1e-6);
  
    nodeExit.select("text")
        .style("fill-opacity", 1e-6);
  
    // Update the links…
    var link = svg.selectAll("path.link")
        .data(links, function(d) { return d.target.id; });
  
    // Enter any new links at the parent's previous position.
    link.enter().insert("path", "g")
        .attr("class", "link")
        .attr("d", function(d) {
          var o = {x: source.x0, y: source.y0};
          return diagonal({source: o, target: o});
        });
  
    // Transition links to their new position.
    link.transition()
        .duration(duration)
        .attr("d", diagonal);
  
    // Transition exiting nodes to the parent's new position.
    link.exit().transition()
        .duration(duration)
        .attr("d", function(d) {
          var o = {x: source.x, y: source.y};
          return diagonal({source: o, target: o});
        })
        .remove();
  
    // Stash the old positions for transition.
    nodes.forEach(function(d) {
      d.x0 = d.x;
      d.y0 = d.y;
    });
  }
  
  // Toggle children on click.
  function click(d) {
    if (d.children) {
      d._children = d.children;
      d.children = null;
    } else {
      d.children = d._children;
      d._children = null;
    }
    update(d);
  }
  