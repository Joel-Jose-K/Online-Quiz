$(document).ready(function(){function e(){$("#external-events .fc-event").each(function(){$(this).data("event",{title:$.trim($(this).text()),color:$(this).css("background-color"),stick:!0}),$(this).draggable({zIndex:999,revert:!0,revertDuration:0})})}e();var t=new Date,a=t.getDate(),n=t.getMonth(),r=t.getFullYear();$("#calendar").fullCalendar({header:{left:"prev,next today",center:"title",right:"month,agendaWeek,agendaDay"},themeSystem:"bootstrap4",droppable:!0,editable:!0,eventLimit:!0,drop:function(){$("#drop-remove").is(":checked")&&$(this).remove()},events:[{title:"Break time",start:new Date(r,n,1),allDay:!0,color:"#ffc107"},{title:"Office Hour",start:new Date(r,n,3)},{title:"Work on a Project",start:new Date(r,n,9),end:new Date(r,n,12),allDay:!0,color:"#d22346"},{title:"Work on a Project",start:new Date(r,n,17),end:new Date(r,n,19),allDay:!0,color:"#d22346"},{id:999,title:"Go to Long Drive",start:new Date(r,n,a-1,15,0)},{id:999,title:"Go to Long Drive",start:new Date(r,n,a+3,15,0)},{title:"Work on a New Project",start:new Date(r,n,a-3),end:new Date(r,n,a-3),allDay:!0,color:"#ffc107"},{title:"Food ",start:new Date(r,n,a+7,15,0),color:"#4caf50"},{title:"Go to Library",start:new Date(r,n,a,8,0),end:new Date(r,n,a,14,0),color:"#ffc107"},{title:"Go for Walk",start:new Date(r,n,25),end:new Date(r,n,27),allDay:!0,color:"#ffc107"},{title:"Work on a Project",start:new Date(r,n,a+8,20,0),end:new Date(r,n,a+8,22,0)}]}),jQuery(".js-form-add-event").on("submit",function(t){t.preventDefault();var a=$("#newEvent").val();$("#newEvent").val(""),$("#external-events").prepend('<li class="list-group-item bg-success fc-event">'+a+"</li>"),e()})});