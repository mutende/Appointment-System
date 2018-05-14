/*
 * author: Lin.Chung	
 * email: zjl_java@163.com
 * address: https://github.com/zhongjinglin/chungTimePicker	
 * date: 2017/9/28
 * version: 1.0
 * Translate to language bahsa Acèh (Indonesian) by Tedir Ghazali
 */

! function($) {

	'use strict';

	$.chungTimePicker = function(element, options) {

		//Peugöt variabel jih
		var obj = {
			ele: $(element),
			hour: ['00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'],
			
			minute: ['00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', 
						'21', '22', '23', '24', '25', '26', '27', '28', '29', '30','31', '32', '33', '34', '35', '36', '37', '38', '39', '40',
						'41', '42', '43', '44', '45', '46', '47', '48', '49', '50','51', '52', '53', '54', '55', '56', '57', '58', '59',],
			errorPrefix: 'ChungTimePicker(error msg): ',
			timepicker: $('<div class="chung-timepicker"></div>'),
			timepicker_hours: $('<div class="chung-timepicker-hours"></div>'),
			timepicker_minutes: $('<div class="chung-timepicker-minutes"></div>'),
			timepicker_bottom: $('<div class="chung-timepicker-bottom"></div>'),
			options: $.extend({}, $.fn.chungTimePicker.defaults, typeof options == 'object' && options),
			originalValue: ''
		}

		//Watè diklik window lheuh nyan gadöh timepicker jih
		$(document).click(function() {
			obj.timepicker.remove();
		});

		//Atoë ulang offset control
		$(window).resize(function() {
			setOffset();
		});

		//Peugadöh fungsi klik dan peugöt timepicker watè diklik
		obj.ele.on('click', function(event) {
			//blokir fungsi peumindahan
			event.preventDefault();
			event.stopPropagation();

			$('.chung-timepicker').remove();

			obj.originalValue = obj.ele.val();

			init();

			//peutheun timepicker bak input field watè diklik dan dituléh
			obj.timepicker.on('click', function(event) {
				event.preventDefault();
				event.stopPropagation();
			});

		})

		//kontrol watè
		function init() {
			createHoursWrap();
			createMinutesWrap();
			createBottomOperate();

			obj.timepicker.append(obj.timepicker_hours)
				.append(obj.timepicker_minutes)
				.append(obj.timepicker_bottom);

			obj.timepicker_hours.removeAttr('style');
			obj.timepicker_minutes.removeAttr('style');

			switch(obj.options.viewType) {
				case 0:
					obj.timepicker_minutes.css('display', 'none');
					break;
				case 1:
					obj.timepicker_hours.css({
						'display': 'inline-block'
					});
					obj.timepicker_minutes.css({
						'display': 'inline-block',
						'margin-left': '20px'
					});
					break;
				default:
					console.log(obj.errorPrefix + 'viewType hana lé, nyang jeut 0 atawa 1, tuëlông peutamöng nilai view type nyang butoi.');
					break;
			}

			setOffset();

			$('body').append(obj.timepicker);

			hoursEvent();
			minutesEvent();
			backHoursView();
			cleanBtnEvent();
		}

		//Watè peugöt view panel
		function createHoursWrap() {
			var table = $('<table class="table-condensed"></table>'),
				title = $('<thead><tr><th colspan="6" class="title">Hour</th></tr></thead>'),
				hours = $('<tbody></tbody>'),
				tempVal = obj.ele.val().split(":")[0],
				td = '';

			for(var i = 0; i < obj.hour.length; i++) {
				if(tempVal == obj.hour[i]) {
					td += '<td class="active">' + obj.hour[i] + '</td>';
				} else {
					td += '<td>' + obj.hour[i] + '</td>';
				}
				if((i + 1) % obj.options.rowCount == 0) {
					var tr = $('<tr></tr>');
					tr.append(td);
					hours.append(tr);
					td = '';
				}
			}

			if(td != '') {
				var tr = $('<tr></tr>');
				tr.append(td);
				hours.append(tr);
			}

			table.append(title)
				.append(hours);

			obj.timepicker_hours.empty().append(table);
		}

		//Peugöt hi panel jih jeut duwa boh
		function createMinutesWrap() {
			var table = $('<table class="table-condensed"></table>'),
				title = $('<thead><tr></tr></thead>'),
				hours = $('<tbody></tbody>'),
				tempVal = obj.ele.val().split(":")[1],
				td = '';

			switch(obj.options.viewType) {
				case 0:
					title.find('tr').append('<th class="prev js-back-hours"><i class="icon-arrow-left"></i></th><th colspan="4" class="title">Minèt</th>');
					break;
				case 1:
					title.find('tr').append('<th colspan="6" class="title">Minutes</th>');
					break;
				default:
					console.log(obj.errorPrefix + 'viewType hana lé, nyang jeut 0 atawa 1, tuëlông peutamöng nilai view type nyang butoi.');
					break;
			}

			for(var i = 0; i < obj.minute.length; i++) {
				if(tempVal == obj.minute[i]) {
					td += '<td class="active">' + obj.minute[i] + '</td>';
				} else {
					td += '<td>' + obj.minute[i] + '</td>';
				}
				if((i + 1) % obj.options.rowCount == 0) {
					var tr = $('<tr></tr>');
					tr.append(td);
					hours.append(tr);
					td = '';
				}
			}

			if(td != '') {
				var tr = $('<tr></tr>');
				tr.append(td);
				hours.append(tr);
			}

			table.append(title)
				.append(hours);

			obj.timepicker_minutes.empty().append(table);
		}

		//Peugöt panel operasi di barôh
		function createBottomOperate() {
			switch(obj.options.viewType) {
				case 0:
					obj.timepicker_bottom.empty().append('<span class="bottom-btn js-clear">Clear</span>')
						.append('<span class="bottom-btn js-cancel">Cansel</span>');
					break;
				case 1:
					obj.timepicker_bottom.empty().append('<span class="bottom-btn js-clear">Clear</span>')
						.append('<span class="bottom-btn js-cancel">Cansel</span>')
						.append('<span class="bottom-btn js-confirm">Set</span>');

					break;
				default:
					console.log(obj.errorPrefix + 'viewType hana lé, nyang jeut 0 atawa 1, tuëlông peutamöng nilai view type nyang butoi.');
					break;
			}
		}

		//peumaté even klik bak panel jeum
		function hoursEvent() {
			obj.timepicker_hours.on('click', 'td', function(event) {
				event.preventDefault();
				event.stopPropagation();

				var _this = $(this);

				obj.timepicker_hours.find('td').removeClass('active');
				_this.addClass('active');

				var hourValue = _this.text().trim();
				var temp = obj.ele.val().split(":");
				if(temp.length > 1) {
					obj.ele.val(hourValue + ":" + temp[1]);
				} else {
					obj.ele.val(hourValue + ":00");
				}

				if(obj.options.viewType == 0) {
					obj.timepicker_hours.hide();
					obj.timepicker_minutes.show();
				}

				return false;
			});
		}

		//even klik bak panel minèt
		function minutesEvent() {
			obj.timepicker_minutes.on('click', 'td', function(event) {
				event.preventDefault();
				event.stopPropagation();

				var _this = $(this);

				obj.timepicker_minutes.find('td').removeClass('active');
				_this.addClass('active');

				var minutesValue = _this.text().trim();
				obj.ele.val(obj.ele.val().split(":")[0] + ":" + minutesValue);

				if(obj.options.viewType == 0) {
					obj.timepicker.remove();
					if(obj.options.callback) obj.options.callback(obj.ele);
				}

				return false;
			});
		}

		//peubalék keu nging jeum
		function backHoursView() {
			if(obj.options.viewType == 0) {
				obj.timepicker_minutes.on('click', '.js-back-hours', function() {
					obj.timepicker_minutes.hide();
					obj.timepicker_hours.show();
				});
			}
		}

		//identitas, peugléh ngön tubiët
		function cleanBtnEvent() {
			obj.timepicker_bottom.on('click', '.js-confirm,.js-clear,.js-cancel', function(event) {
				event.preventDefault();
				event.stopPropagation();

				var _this = $(this);

				if(_this.hasClass('js-confirm')) {
					obj.timepicker.remove();
					if(obj.options.confirmCallback) obj.options.confirmCallback(obj.ele);

				} else if(_this.hasClass('js-clear')) {
					obj.ele.val('');
					obj.timepicker.remove();
					if(obj.options.clearCallback) obj.options.clearCallback(obj.ele);

				} else if(_this.hasClass('js-cancel')) {
					obj.ele.val(obj.originalValue);
					obj.timepicker.remove();
					if(obj.options.cancelCallback) obj.options.cancelCallback(obj.ele);

				} else {
					console.log(obj.errorPrefix + '不存在的操作按钮');
				}

				return false;
			});
		}

		//atoë kontrol view offset
		function setOffset() {
			var offset = obj.ele.offset();

			obj.timepicker.css({
				'left': offset.left,
				'top': offset.top + obj.ele.outerHeight()
			});
		}

	};

	//jQuery Peupanyang
	$.fn.extend({
		chungTimePicker: function(options) {
			this.each(function() {
				new $.chungTimePicker(this, options);
			});
			return this;
		}
	});

	//parameter asai
	$.fn.chungTimePicker.defaults = {
		viewType: 0, //Nging jeunèh tampilan, 0: duwa tampilan tampilan, 1: tampilan nyang dipeudeuh, nakeuh jeum dan minèt bak panel
		rowCount: 6, //jumlah baréh nyang dipeudeuh per baréh
	};

}(window.jQuery);