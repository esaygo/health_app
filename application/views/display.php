<?php
  // var_dump($notes);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
	<title>JSON data</title>
  <script type="text/javascript" src='http://code.jquery.com/jquery-2.2.2.js'></script>
  <script>
    var base = 'http://eutils.ncbi.nlm.nih.gov/entrez/eutils/';
    var interests = [];
    var count;
    var db = 'pubmed';
    var logged_in = <?php echo json_encode(isset($this->session->userdata['login_info']['id']) && $this->session->userdata['login_info']['id'] != null); ?>;
    if(logged_in){
      // console.log("You're logged in");
      $.ajax({
        url: '/script',
        dataType: 'json',
        cache: false,
        success: function(data){
          // console.log("Call success");
          interests = data;
          console.log(interests);
          count = interests.length;
          get_interests(count, interests);
        }, type: 'GET'
      });
    }
    else{
      // console.log("Please log in");
      interests = ['Blood Pressure', 'Diabetes', 'Depression', 'Seasonal Allergies', 'Eye disease', 'Heart Disease'];
      // console.log(typeof interests);
      count = interests.length;
      console.log(count);
      get_interests(count, interests);
    }

    function get_interests(count, interests){
      for(var i=0; i<count; i++){
        var interest = interests[i];
        console.log(interest);
        // console.log(count);
        var query = interest.replace(/[^a-z0-9]+/gi, '+');
        // console.log(query);
        var retmax = 6 / count;
        var url = base + 'esearch.fcgi?db='+db+'&retmode=json&term='+query+'&field=title&retmax='+retmax;
        $.get(url, function(res) {
          display(res.esearchresult.idlist);
        }, 'json');
      }
    }

    function display(idlist){
      var base2 = 'http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi';
      for(var i=0; i<idlist.length; i++){
        var url2 = base2 + '?db='+db+'&retmode=xml&id='+idlist[i];
        $.get(url2, function(xml) {
          var json = (xmlToJson(xml));
          var title = json.PubmedArticleSet[1].PubmedArticle.MedlineCitation.Article.ArticleTitle["#text"];
          var pmid = json.PubmedArticleSet[1].PubmedArticle.MedlineCitation.PMID["#text"];
          $('#ncbi-news').append("<p><a href='http://www.ncbi.nlm.nih.gov/pubmed/" + pmid + "' target='_blank'>" + title + "</a></p>");
        }, 'xml');
      }
    }

    function xmlToJson(xml) {
    	var obj = {};
    	if (xml.nodeType == 1) { // element
    		// do attributes
    		if (xml.attributes.length > 0) {
    		obj["@attributes"] = {};
    			for (var j = 0; j < xml.attributes.length; j++) {
    				var attribute = xml.attributes.item(j);
    				obj["@attributes"][attribute.nodeName] = attribute.nodeValue;
    			}
    		}
    	} else if (xml.nodeType == 3) {
    		obj = xml.nodeValue;
    	}

    	// do children
    	if (xml.hasChildNodes()) {
    		for(var i = 0; i < xml.childNodes.length; i++) {
    			var item = xml.childNodes.item(i);
    			var nodeName = item.nodeName;
    			if (typeof(obj[nodeName]) == "undefined") {
    				obj[nodeName] = xmlToJson(item);
    			} else {
    				if (typeof(obj[nodeName].push) == "undefined") {
    					var old = obj[nodeName];
    					obj[nodeName] = [];
    					obj[nodeName].push(old);
    				}
    				obj[nodeName].push(xmlToJson(item));
    			}
    		}
    	}
    	return obj;
    };
  </script>
</head>
<body>
	<div id='ncbi-news'></div>
</body>
</html>
