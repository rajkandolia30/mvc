var Base = function(){};
Base.prototype = {
	url : null,
	params : {},
	method : 'post',

	alert : function(){
		alert(111);
	},
	setUrl : function(url){
		this.url = url;
		return this;
	},
	getUrl : function(){
		return this.url;
	},
	setMethod : function(method){
		this.method = method;
		return this;
	},
	getMethod : function(){
		return this.method;
	},
	setParams : function(params){
		this.params = params;
		return this;
	},
	getParams : function(key){
		if(typeof key === 'undefined'){
			return this.params;
		}
		if(typeof this.params[key] === 'udefined'){
			return null;
		}
		return this.params[key];
	},
	addparams : function(key, value){
		this.params[key] = value;
		return this;
	},
	resetParams : function(){
		this.params = {};
		return this;
	},
	removeParam : function(){
		if(typeof this.params[key] != 'undefined'){
			delete this.params[key];
		}
		return this;
	},
	load : function(){
		var self = this;
		var request = $.ajax({
			method : this.getMethod(),
			url : this.getUrl(),
			data : this.getParams(),
			success : function(response){
				self.manageHtml(response);
			}
		});
	},
	manageHtml : function(response){
		if(typeof response.element == 'undefined'){
			return false;
		}
		if(typeof response.element == 'object'){
			$(response.element).each(function(i,element){
				$(element.selector).html(element.html);
			})
		} else {
			$(response.element.selector).html(response.element.html);
		}
	},
	setForm : function(formId){
		var form = $(formId);
		this.setMethod(form.attr('method'));
		this.setUrl(form.attr('action'));
		this.setParams(form.serialize());
		console.log(form.attr('action'));
		console.log(form.serialize());
		return this;
	},
	upload : function(){
		var fd = new FormData();
  		var files = $('#file')[0].files;
  		fd.append('file',files[0]);
  		
  		formId = '#'+$('form').attr('id');
		this.setParams(fd);
		this.setUrl($(formId).attr('action'));
		this.setMethod($(formId).attr('method'));

		var request = $.ajax({
		  method: this.getMethod(),
		  url: this.getUrl(),
		  data: this.getParams(),
		  contentType: false,
          processData: false,
		  success: function(response){
		  	$.each(response.element, function(i, element){
		  		$(element.selector).html(element.html);
		  	});
		  }
		});		
	}
}
 