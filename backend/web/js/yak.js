/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$(document).ready(function(){
//    var url = document.location.toString();
//if (url.match('#')) {
//    $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
//} 
//
//// Change hash for page-reload
//$('.nav-tabs a').on('shown.bs.tab', function (e) {
//    window.location.hash = e.target.hash;
//})
//    
//    
////    var gotoHashTab = function (customHash) {
////        var hash = customHash || location.hash;
////        var hashPieces = hash.split('?');
////            var activeTab = $('[href=' + hashPieces[0] + ']');
////        activeTab && activeTab.tab('show');
////    }
////
////    // onready go to the tab requested in the page hash
////    gotoHashTab();
////
//    // when the nav item is selected update the page hash
//    $('.nav a').on('shown', function (e) {
//        window.location.hash = e.target.hash;
//    })
//
//    // when a link within a tab is clicked, go to the tab requested
//    $('.tab-pane a').click(function (event) {
//        if (event.target.hash) {
//            gotoHashTab(event.target.hash);
//        }
//    });
//    });

function initialSelect() {
    if (hasStorage) {
        var activeTab = window.localStorage.getItem("_bs_activeTab_" + getControllerId());
        if (activeTab !== "") {
            jQuery("[href='" + activeTab + "']").tab("show");
        }
    }
}