<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">HTML (DOM) sourced data</h5>
		<div class="heading-elements">
			<ul class="icons-list">
				<li><a data-action="collapse"></a></li>
				<li><a data-action="reload"></a></li>
				<li><a data-action="close"></a></li>
			</ul>
		</div>
	</div>

	<div class="panel-body">
		Basic example of a datatable with <code>HTML (DOM)</code> sourced data. The foundation for DataTables is progressive enhancement, so it is very adept at reading table information directly from the <code>DOM</code>. This example shows how easy it is to add searching, ordering and paging to your HTML table by simply running DataTables with basic configuration on it.
	</div>

	<table class="table datatable-html">
		<thead>
			<tr>
				<th>Name</th>
				<th>Position</th>
				<th>Age</th>
				<th>Start date</th>
				<th>Salary</th>
				<th class="text-center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Tiger Nixon</td>
				<td>System Architect</td>
				<td>61</td>
				<td><a href="#">2011/04/25</a></td>
				<td><span class="label label-info">$320,800</span></td>
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
								<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
								<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td>Garrett Winters</td>
				<td>Accountant</td>
				<td>63</td>
				<td><a href="#">2011/07/25</a></td>
				<td><span class="label label-danger">$170,750</span></td>
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
								<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
								<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td>Ashton Cox</td>
				<td>Junior Technical Author</td>
				<td>66</td>
				<td><a href="#">2009/01/12</a></td>
				<td><span class="label label-default">$86,000</span></td>
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
								<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
								<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td>Cedric Kelly</td>
				<td>Senior Javascript Developer</td>
				<td>22</td>
				<td><a href="#">2012/03/29</a></td>
				<td><span class="label label-success">$433,060</span></td>
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
								<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
								<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td>Airi Satou</td>
				<td>Accountant</td>
				<td>33</td>
				<td><a href="#">2008/11/28</a></td>
				<td><span class="label label-danger">$162,700</span></td>
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
								<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
								<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td>Brielle Williamson</td>
				<td>Integration Specialist</td>
				<td>61</td>
				<td><a href="#">2012/12/02</a></td>
				<td><span class="label label-info">$372,000</span></td>
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
								<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
								<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td>Herrod Chandler</td>
				<td>Sales Assistant</td>
				<td>59</td>
				<td><a href="#">2012/08/06</a></td>
				<td><span class="label label-danger">$137,500</span></td>
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
								<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
								<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td>Rhona Davidson</td>
				<td>Integration Specialist</td>
				<td>55</td>
				<td><a href="#">2010/10/14</a></td>
				<td><span class="label label-default">$97,900</span></td>
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
								<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
								<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td>Colleen Hurst</td>
				<td>Javascript Developer</td>
				<td>39</td>
				<td><a href="#">2009/09/15</a></td>
				<td><span class="label label-success">$405,500</span></td>
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
								<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
								<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td>Sonya Frost</td>
				<td>Software Engineer</td>
				<td>23</td>
				<td><a href="#">2008/12/13</a></td>
				<td><span class="label label-danger">$103,600</span></td>
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
								<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
								<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td>Jena Gaines</td>
				<td>Office Manager</td>
				<td>30</td>
				<td><a href="#">2008/12/19</a></td>
				<td><span class="label label-danger">$90,560</span></td>
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
								<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
								<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td>Quinn Flynn</td>
				<td>Support Lead</td>
				<td>22</td>
				<td><a href="#">2013/03/03</a></td>
				<td><span class="label label-info">$342,000</span></td>
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
								<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
								<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td>Charde Marshall</td>
				<td>Regional Director</td>
				<td>36</td>
				<td><a href="#">2008/10/16</a></td>
				<td><span class="label label-success">$470,600</span></td>
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
								<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
								<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td>Haley Kennedy</td>
				<td>Senior Marketing Designer</td>
				<td>43</td>
				<td><a href="#">2012/12/18</a></td>
				<td><span class="label label-danger">$113,500</span></td>
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
								<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
								<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td>Tatyana Fitzpatrick</td>
				<td>Regional Director</td>
				<td>19</td>
				<td><a href="#">2010/03/17</a></td>
				<td><span class="label label-info">$385,750</span></td>
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
								<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
								<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<script type="text/javascript" src="<?php echo base_url();?>public/modulos/perfil.js"></script>