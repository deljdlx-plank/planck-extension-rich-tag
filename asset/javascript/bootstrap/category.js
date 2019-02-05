$(function() {


    var options = {
        sourceURL: '?/tag/api/category/get-tree',
        createNodeURL: '?/tag/api/category/save',
        renameNodeURL: '?/tag/api/category/save',
        moveNodeURL: '?/tag/api/category/move',
        deleteURL: '?/tag/api/category/delete',
        deleteBranchURL: '?/tag/api/category/delete-branch',


    };

    var tree = new Planck.Extension.ViewComponent.View.Component.EntityTree(options)
    tree.render('.plk-category-container');



});