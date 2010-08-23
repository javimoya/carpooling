<?php 

   include("includes/general.inc.php");
      
   get_header();
   
?>   

			<div class="contentArea">
				<!-- Title / Page Headline -->
				<div class="full-page">
					<h1 class="headline"><strong>Text</strong> &nbsp;//&nbsp; Samples of text formatting options</h1>
				</div>
				
				<div class="hr"></div>

				<!-- Breadcrumbs -->
				<div class="full-page">
					<p class="breadcrumbs">
						<a href="index.html">Home</a> <span>&raquo;</span> <a href="#">Some Page</a> <span>&raquo;</span> <a href="#">Some Page</a> <span>&raquo;</span> This Page
					</p>
				</div>
				
				<!-- End of Content -->
				<div class="clear"></div>
			</div>
			
			<div class="contentArea">
				<div class="full-page">
				
					<!-- Text samples -->

					<h2 class="headline">Headings</h2>
					<div class="hr"></div>

					<p>
						Samples of the heading text for this theme: <code>&lt;h1&gt;</code>, <code>&lt;h2&gt;</code>, <code>&lt;h3&gt;</code>, <code>&lt;h4&gt;</code>, <code>&lt;h5&gt;</code>, <code>&lt;h6&gt;</code>
					</p>
					<div style="padding: 15px 35px;">
						<h1>This is a Heading 1 Element</h1>
						<h2>This is a Heading 2 Element</h2>
						<h3>This is a Heading 3 Element</h3>
						<h4>This is a Heading 4 Element</h4>
						<h5>This is a Heading 5 Element</h5>
						<h6>This is a Heading 6 Element</h6>
					</div>
					
					<br />
					<h2 class="headline">Headlines / Page Titles</h2>
					<div class="hr"></div>
					<p>
						Headlines are a different color than standard headings and can be assigned to any H1-H6 tag using <code>class="headline"</code>.
						To create a highlight, place <code>&lt;strong&gt;</code> tags around the words to be highlighted.
					</p>
					
					<div style="padding: 15px 35px;">
						<h1 class="headline">This headline has a <strong>highlight</strong> in it.</h1>
						<code>&lt;h1 class="headline"&gt;This headline has a &lt;strong&gt;highlight&lt;/strong&gt; in it.&lt;/h1&gt;</code>
					</div>
						
					<br />
					<h2 class="headline">Sub-Headings</h2>
					<div class="hr"></div>
					<p>
						Add a sub-heading to any H1-H6 tag using <code>&lt;span&gt;</code> tag.
					</p>
					
					<div style="padding: 15px 35px;">
						<h1>
							Heading Text
							<span>This is a sub-heading</span>
						</h1>
												
						<code>&lt;h1&gt;Heading Text&lt;span&gt;This is a sub-heading&lt;/span&gt;&lt;/h1&gt;</code>
					</div>

					<!-- End of Content -->
					<div class="clear"></div>
					
				</div>
				
				<!-- End of Content -->
				<div class="clear"></div>
					
				<!-- Title / Page Headline -->
				<div class="full-page">
					<br />
					<h2 class="headline">List Styles</h2>
					<div class="hr"></div>
				</div>
				
				<!-- End of Content -->
				<div class="clear"></div>
									
				<div class="half-page">
					
					<h4>Bulleted Lists</h4>
					<p>The following styles for bulleted lists are available. Add the class name associated with a bullet to the UL tag for your list to use the desired style.</p>
					<ul class="bullet-check">
						<li>Check mark</li> 
						<li><code>&lt;ul class="<strong>bullet-check</strong>"&gt;</code></li>
					</ul>
					<ul class="bullet-black">
						<li>Black</li> 
						<li><code>&lt;ul class="<strong>bullet-black</strong>"&gt;</code></li>
					</ul>
					<ul class="bullet-gray">
						<li>Gray (defalut if no class entered)</li> 
						<li><code>&lt;ul class="<strong>bullet-gray</strong>"&gt;</code></li>
					</ul>
					<ul class="bullet-silver">
						<li>Silver</li> 
						<li><code>&lt;ul class="<strong>bullet-silver</strong>"&gt;</code></li>
					</ul>
					<ul class="bullet-blue">
						<li>Blue</li> 
						<li><code>&lt;ul class="<strong>bullet-blue</strong>"&gt;</code></li>
					</ul>
					<ul class="bullet-green">
						<li>Green</li> 
						<li><code>&lt;ul class="<strong>bullet-green</strong>"&gt;</code></li>
					</ul>
					<ul class="bullet-orange">
						<li>Orange</li> 
						<li><code>&lt;ul class="<strong>bullet-orange</strong>"&gt;</code></li>
					</ul>
					<ul class="bullet-red">
						<li>Red</li> 
						<li><code>&lt;ul class="<strong>bullet-red</strong>"&gt;</code></li>
					</ul>
					<ul class="bullet-disc-black">
						<li>Disc Black</li> 
						<li><code>&lt;ul class="<strong>bullet-disc-black</strong>"&gt;</code></li>
					</ul>
					<ul class="bullet-disc-gray">
						<li>Disc Gray</li> 
						<li><code>&lt;ul class="<strong>bullet-disc-gray</strong>"&gt;</code></li>
					</ul>
					<ul class="bullet-disc-silver">
						<li>Disc Silver</li> 
						<li><code>&lt;ul class="<strong>bullet-disc-silver</strong>"&gt;</code></li>
					</ul>
					<ul class="bullet-disc-blue">
						<li>Disc Blue</li> 
						<li><code>&lt;ul class="<strong>bullet-disc-blue</strong>"&gt;</code></li>
					</ul>
					<ul class="bullet-disc-green">
						<li>Disc Green</li> 
						<li><code>&lt;ul class="<strong>bullet-disc-green</strong>"&gt;</code></li>
					</ul>
					<ul class="bullet-disc-orange">
						<li>Disc Orange</li> 
						<li><code>&lt;ul class="<strong>bullet-disc-orange</strong>"&gt;</code></li>
					</ul>
					<ul class="bullet-disc-red">
						<li>Disc Red</li> 
						<li><code>&lt;ul class="<strong>bullet-disc-red</strong>"&gt;</code></li>
					</ul>
					
					<!-- End of Content -->
					<div class="clear"></div>					
				
				</div>
							
				<div class="half-page">
					<h4>Numbered Lists</h4>
					<p>Choose from the following numbered list styles.</p>
					<ol class="number-pad">
						<li>Numbered item <code>&lt;ol class="<strong>number-pad</strong>"&gt;</code></li>
						<li>Numbered item</li>
						<li>Numbered item</li>
						<li>Numbered item</li>
						<li>Numbered item</li>
					</ol>
					<ol>
						<li>Numbered item (defalut, no class)</li>
						<li>Numbered item</li>
						<li>Numbered item</li>
						<li>Numbered item</li>
						<li>Numbered item</li>
					</ol>

					<h4>Custom Lists</h4>
					<p>
						A custom list style for displaying previews of news or blog posts. <br />
						<code>&lt;ul class="<strong>post-list</strong>"&gt;</code>.
					</p>
					<ul class="post-list" style="width: 300px;">
						<li>
							<img src="images/content/placeholder_48x48.png" width="48" height="48" alt="Recent News" />
							<a href="#">News/Blog Posts List</a>
							<p>This can include information such as a title, date, image and short description.</p>
						</li>
						<li>
							<img src="images/content/placeholder_48x48.png" width="48" height="48" alt="Recent News" />
							<a href="#">News/Blog Posts List</a>
							<p>This can include information such as a title, date, image and short description.</p>
						</li>
						<li>
							<img src="images/content/placeholder_48x48.png" width="48" height="48" alt="Recent News" />
							<a href="#">News/Blog Posts List</a>
							<p>This can include information such as a title, date, image and short description.</p>
						</li>
					</ul>
					<p>The "post-list" style can include the following HTML elements: <code>IMG</code>, <code>A</code>, <code>P</code>. Below is a sample implementation of the style.</p>
<pre>
&lt;ul class="post-list"&gt;
&lt;li&gt;
	&lt;img src="image.jpg" /&gt;
	&lt;a href="#"&gt;Title&lt;/a&gt;
	&lt;p&gt;Description text for this entry.&lt;/p&gt;
&lt;/li&gt;
&lt;li&gt;
	&lt;img src="image.jpg" /&gt;
	&lt;a href="#"&gt;Title&lt;/a&gt;
	&lt;p&gt;Description text for this entry.&lt;/p&gt;
&lt;/li&gt;
&lt;li&gt;
	&lt;img src="image.jpg" /&gt;
	&lt;a href="#"&gt;Title&lt;/a&gt;
	&lt;p&gt;Description text for this entry.&lt;/p&gt;
&lt;/li&gt;
&lt;/ul&gt;
</pre>
					<!-- End of Content -->
					<div class="clear"></div>
					
				</div>

				<!-- End of Content -->
				<div class="clear"></div>

			</div>
			<div class="contentArea">
				<div class="full-page">
					
					<br />
					<h2 class="headline">Blockquote</h2>
					<div class="hr"></div>

					<blockquote>
						<div>This is the default blockquote style applied to this theme's <code>&lt;blockquote&gt;</code> tags. Each skin has a custom color for the blockquote style. You can also create your own custom styles to match any skin using the following code in your stylesheet:</div>
						
<pre style="margin-top:8px;">
blockquote {
	border-color: [your color];
}
</pre>
					</blockquote>

					<br />
					<h2 class="headline">Other Text</h2>
					<div class="hr"></div>

					<h4>Paragraph text sample:</h4>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In pretium, leo ac hendrerit vulputate, libero libero congue ipsum, nec consectetur nunc arcu in tortor. Phasellus eu cursus nunc. Duis eros nulla, mollis eu molestie id, commodo gravida massa. Nullam mollis, nisl nec sodales hendrerit, diam nunc auctor arcu, eget suscipit lectus metus nec lacus.</p>
<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse nibh tortor, aliquet vel pellentesque ac, interdum non mauris. Donec est eros, fringilla vitae commodo non, pretium vel tortor. Quisque sed elit mi. Sed tortor nunc, egestas eu suscipit sed, faucibus a nisl. Praesent eros orci, viverra vitae vestibulum quis, luctus feugiat ipsum.</p>
<p>Nullam tristique nunc quis ante dapibus vel tincidunt turpis ornare. Nullam ante arcu, viverra ac rhoncus id, pretium eget magna. Aliquam quis massa urna, accumsan pellentesque sapien. </p>
					<br />

					<h4>Abbreviation, acronym, cite, delete, insert...</h4>
					
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td style="padding: 3px 8px 3px 0;"><abbr>abbr</abbr></td>
							<td style="padding: 3px 8px 3px 0;"><code>&lt;abbr&gt;</code></td>
						</tr>
						<tr>
							<td style="padding: 3px 8px 3px 0;"><acronym>a.c.r.o.n.y.m</acronym></td>
							<td style="padding: 3px 8px 3px 0;"><code>&lt;acronym&gt;</code></td>
						</tr>
						<tr>
							<td style="padding: 3px 8px 3px 0;"><cite>This is cited.</cite></td>
							<td style="padding: 3px 8px 3px 0;"><code>&lt;cite&gt;</code></td>
						</tr>
						<tr>
							<td style="padding: 3px 8px 3px 0;"><del>Deleted text</del></td>
							<td style="padding: 3px 8px 3px 0;"><code>&lt;del&gt;</code></td>
						</tr>
						<tr>
							<td style="padding: 3px 8px 3px 0;"><ins>Inserted text</ins></td>
							<td style="padding: 3px 8px 3px 0;"><code>&lt;ins&gt;</code></td>
						</tr>
						<tr>
							<td style="padding: 3px 8px 3px 0;"><dfn>This is a definition.</dfn></td>
							<td style="padding: 3px 8px 3px 0;"><code>&lt;dfn&gt;</code></td>
						</tr>
						<tr>
							<td style="padding: 3px 8px 3px 0;"><em>With emphysis</em></td>
							<td style="padding: 3px 8px 3px 0;"><code>&lt;em&gt;</code></td>
						</tr>
						<tr>
							<td style="padding: 3px 8px 3px 0;"><strong>Strong (bold)</strong></td>
							<td style="padding: 3px 8px 3px 0;"><code>&lt;strong&gt;</code></td>
						</tr>
						<tr>
							<td style="padding: 3px 8px 3px 0;"><code>Code text sample</code></td>
							<td style="padding: 3px 8px 3px 0;"><code>&lt;code&gt;</code></td>
						</tr>
					</table>
					<p><br /></p>

					<h4>Predefined text:</h4>
<pre style="width: 400px;">
This is predefined text with custom spacing and tabs.

body {
	margin: 0;
	padding: 0;
	background: none;
	font-style: normal;
	color: #000;
}
</pre> 


					<p><br /></p>
					<h4>Table layout:</h4>
					<table cellspacing="0" cellpadding="0" id="FeatureMatrix">
						<tbody>
							<tr>
								<th id="MatrixItems">&nbsp;</th>
								<th class="matrixColumn">
									<h6>Column Title</h6>
									<p><a href="#">Column Link</a></p>
								</th>
								<th class="matrixColumn">
									<h6>Column Title</h6>
									<p><a href="#">Column Link</a></p>
								</th>
								<th class="matrixColumn">
									<h6>Column Title</h6>
									<p><a href="#">Column Link</a></p>
								</th>
								<th class="matrixColumn">
									<h6>Column Title</h6>
									<p><a href="#">Column Link</a></p>
								</th>
							</tr>
							<tr>
								<td class="matrixItem">Item</td>
								<td class="matrixOdd">value / option</td>
								<td class="matrixEven">value / option</td>
								<td class="matrixOdd">value / option</td>
								<td class="matrixEven">value / option</td>
							</tr>
							<tr>
								<td class="matrixItem">Item</td>
								<td class="matrixOdd">value / option</td>
								<td class="matrixEven">value / option</td>
								<td class="matrixOdd">value / option</td>
								<td class="matrixEven">value / option</td>
							</tr>
							<tr>
								<td class="matrixItem">Item</td>
								<td class="matrixOdd">value / option</td>
								<td class="matrixEven">value / option</td>
								<td class="matrixOdd">value / option</td>
								<td class="matrixEven">value / option</td>
							</tr>
							<tr>
								<td class="matrixItem">Item</td>
								<td class="matrixOdd">value / option</td>
								<td class="matrixEven">value / option</td>
								<td class="matrixOdd">value / option</td>
								<td class="matrixEven">value / option</td>
							</tr>
							<tr>
								<td class="matrixItem last">Item</td>
								<td class="matrixOdd checkMark last">&nbsp;</td>
								<td class="matrixEven checkMark last">&nbsp;</td>
								<td class="matrixOdd checkMark last">&nbsp;</td>
								<td class="matrixEven checkMark last">&nbsp;</td>
							</tr>
						</tbody>
					</table>

					<br />
					
					<!-- End of Content -->
					<div class="clear"></div>					
				
				</div>
				
			</div>


<?php 

   get_footer();
   
?>
			
			