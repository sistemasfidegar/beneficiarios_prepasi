
        
         <style>
        
	        .error {
			    background: url("resources/formulario/css/images/ui-bg_glass_95_fef1ec_1x400.png") repeat-x scroll 50% 50% #fef1ec !important;
			    border: 1px solid #cd0a0a !important;
			    color: #cd0a0a;
			}
			        
	        .leyenda
	        {
	        	font-size:25px !important;
	        	font-weight: bold;        
	        }
        	.ui-tooltip, .arrow:after {
		        background: white;
		        border: 2px solid #cd0a0a;
		    }
		    .ui-tooltip {
		        padding: 5px 20px;
		        color: #cd0a0a;
		        border-radius: 10px;
		        font: bold 12px "Helvetica Neue", Sans-Serif;
		        box-shadow: 0 0 4px #cd0a0a;
		    }
		    .arrow {
		        width: 70px;
		        height: 16px;
		        overflow: hidden;
		        position: absolute;
		        left: 50%;
		        margin-left: -35px;
		        bottom: -16px;
		    }
		    .arrow.top {
		        top: -16px;
		        bottom: auto;
		    }
		    .arrow.left {
		        left: 20%;
		    }
		    .arrow:after {
		        content: "";
		        position: absolute;
		        left: 20px;
		        top: -20px;
		        width: 25px;
		        height: 25px;
		        box-shadow: 6px 5px 9px -9px black;
		        -webkit-transform: rotate(45deg);
		        -ms-transform: rotate(45deg);
		        transform: rotate(45deg);
		    }
		    .arrow.top:after {
		        bottom: -20px;
		        top: auto;
		    }
		    input
			{
				background: #CCC;
				border-width:2px;
				border-style:dashed;
				border-color:##FF0000;
			}
			
        </style>
        
<form role="form">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="exampleInputFile">
    <p class="help-block">Example block-level help text here.</p>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox"> Check me out
    </label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>