<?php
  // var_dump($this->session->userdata['login_info']);
  var_dump($this->session->all_userdata());
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>NCBI API TEST</title>
  <script type="text/javascript" src='http://code.jquery.com/jquery-2.2.2.js'></script>
  <script>
    var interests = <?php echo json_encode($this->session->userdata['interest_info']); ?>;
    var count = interests.length;
    var db = 'pubmed';
    // var retmax = '6';
    var base = 'http://eutils.ncbi.nlm.nih.gov/entrez/eutils/';
    $(document).ready(function() {
      $('.keyword').focus();
      $('.information').html('');
      get_interests(count);
      return false;
    });

    function get_interests(count){
      for(var i=0; i<count; i++){
        var interest = interests[i];
        // console.log(interest);
        // console.log(count);
        var query = interest['type'].replace(/[^a-z0-9]+/gi, '+');
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
          $('.information').append("<p><a href='http://www.ncbi.nlm.nih.gov/pubmed/" + pmid + "' target='_blank'>" + title + "</a></p>");
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
  <style>
    .wrapper{
      width: 1000px;
    }
  </style>
</head>
<body>
  <div class='wrapper'>
    <form>
      <input type='text' name='keyword' class='keyword'>
      <input type='submit' value='Search'>
    </form>
    <p><a href='/logout'>Log Out</a></p>
    <div class='information'></div>
  </div>
</body>
</html>
