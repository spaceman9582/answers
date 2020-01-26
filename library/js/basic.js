/*
 * SimpleModal Basic Modal Dialog
 * //www.ericmmartin.com/projects/simplemodal/
 * //code.google.com/p/simplemodal/
 *
 * Copyright (c) 2009 Eric Martin - //ericmmartin.com
 *
 * Licensed under the MIT license:
 *   //www.opensource.org/licenses/mit-license.php
 *
 * Revision: $Id: basic.js 212 2009-09-03 05:33:44Z emartin24 $
 *
 */

$(document).ready(function () {
	
	$('p.propertylistinglinks span.emailagent a' ).click(function (e) {
		e.preventDefault();
		$('#basic-modal-content2').modal();
	});
		
});