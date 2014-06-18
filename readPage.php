<?php 

include 'simple_html_dom.php'; 
 
$i=0;
$opts = array('http'=>array('header' => "User-Agent:Mozilla/5.0\r\n"));
$context = stream_context_create($opts);
$findme1 = '.edu';
$findme2 = '@';
 
 // Create a DOM object
$html = new simple_html_dom();
   
// Load HTML from a HTML file
$html->load_file('page1.html');

//$html = file_get_html('page1.html',false,$context);

	if (empty($html)) { 

			print "HTML could not be read <br>"; 

			} else {

			foreach($html->find('a[class=instructorLink]') as $element) { 

			    $var = file_get_html($element->href,false,$context);
				
				if (empty($var)) 
				{ 
						print "Instructor's HTML could not be read <br>"; 

				} else { 

				$limit=0;
				foreach($var->find('span') as $email) { 

					if(strpos($email, $findme1) AND strpos($email, $findme2)) { 
						if($limit++ == 1) break;
						echo $i++ . ' '; 
						echo $email . '<br>'; 
					}
				}

				}
		       

		    }

	}


?>