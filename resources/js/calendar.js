import axios from "axios";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from '@fullcalendar/timegrid';

function formatDate(date, pos) {
    var dt = new Date(date);
    if(pos==="end"){
        dt.setDate(dt.getDate() - 1);
    }
    return dt.getFullYear() + '-' +('0' + (dt.getMonth()+1)).slice(-2)+ '-' +  ('0' + dt.getDate()).slice(-2);
}

// カレンダーを表示させたいタグのidを取得
var calendarEl = document.getElementById("calendar");

// カレンダーの設定

let calendar = new Calendar(calendarEl, {
    plugins: [dayGridPlugin, timeGridPlugin],
    initialView: "dayGridMonth",
    customButtons: {
        eventAddButton: {
            text: '予定を追加',
            click: function() {
                // 初期化
                // ...
            }
        }
    },
    headerToolbar: {
        start: "prev,next today",
        center: "title",
        end: "dayGridMonth,timeGridWeek",
    },
    height: "auto",
    events: function (info, successCallback, failureCallback) {
        axios
            .post("/calendar/get", {
                start_date: info.start.valueOf(),
                end_date: info.end.valueOf(),
            })
            .then((response) => {
                calendar.removeAllEvents();
                successCallback(response.data);
            })
            .catch((error) => {
                alert("登録に失敗しました。");
            });
    },
    eventClick: function(info) {
        // ...
    },
    
    // 新たに追加する設定オプション
    datesAboveResources: true,
    views: {
        resourceTimeGridOneDay: {
            type: 'resourceTimeGrid',
            duration: { days: 1 },
            buttonText: '1日'
        },
        // 他のビューの設定を追加
        resourceTimelineDayGroup: {
            type: 'resourceTimelineDay',
            resourceGroupField: 'building',
            buttonText: 'グループ'
        },
    },
    resources: function (info, successCallback, failureCallback) {
        axios
            .post("resourceGet", {
                // リソース取得のパラメータ
            })
            .then((response) => {
                successCallback(response.data);
            })
            .catch((error) => {
                alert("リソースの取得に失敗しました。");
            });
    },
});

// カレンダーのレンダリング
calendar.render();

window.closeAddModal = function(){
    document.getElementById('modal-add').style.display = 'none';
};
window.closeUpdateModal = function(){
    document.getElementById('modal-update').style.display = 'none';
};
window.deleteEvent = function(){
    'use strict';

    if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
        document.getElementById('delete-form').submit();
    } 
};