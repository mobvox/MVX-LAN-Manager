$(function(){

	var disabled_anchor = '#content #centercontent #contenttable #table #tablebody .tr a.disabled';
	var table_anchor = '#content #centercontent #contenttable #table #tablebody .tr a';

	$(table_anchor).tipsy({
		title: function(){
			return $(this).attr('alt');
		},
		gravity: $.fn.tipsy.autoNS
	})
	$(table_anchor + ".showdialog").click(function(){
		var $dialog = $('<div></div>').html('Para conectar-se a esta maquina utilize esse endere&ccedil;o: ' + $(this).attr('href')).dialog({
			modal: true,
			title: 'Aten&ccedil;&atilde;o'
		});
		return false;
	})
	$(disabled_anchor).click(function(){
		return false;
	})
});