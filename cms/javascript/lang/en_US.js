if(typeof(ss) == 'undefined' || typeof(ss.i18n) == 'undefined') {
	if(typeof(console) != 'undefined') console.error('Class ss.i18n not defined');
} else {
	ss.i18n.addDictionary('en_US', {
		'CMSMAIN.WARNINGSAVEPAGESBEFOREADDING' : "You have to save a page before adding children underneath it",
		'CMSMAIN.CANTADDCHILDREN' : "You can't add children to the selected node",
		'CMSMAIN.ERRORADDINGPAGE' : 'Error adding page',
		'CMSMAIN.FILTEREDTREE' : 'Filtered tree to only show changed pages',
		'CMSMAIN.ERRORFILTERPAGES' : 'Could not filter tree to only show changed pages<br />%s',
		'CMSMAIN.ERRORUNFILTER' : 'Could not unfilter site tree<br />%s',
		'CMSMAIN.ERRORUNFILTER' : 'Unfiltered tree',
		'CMSMAIN.PUBLISHINGPAGES' : 'Publishing pages...',
		'CMSMAIN.SELECTONEPAGE' : "Please select at least 1 page.",
		'CMSMAIN.ERRORPUBLISHING' : 'Error publishing pages',
		'CMSMAIN.REALLYDELETEPAGES' : "Do you really want to delete the %s marked pages?",
		'CMSMAIN.DELETINGPAGES' : 'Deleting pages...',
		'CMSMAIN.ERRORDELETINGPAGES': 'Error deleting pages',
		'CMSMAIN.PUBLISHING' : 'Publishing...',
		'CMSMAIN.RESTORING': 'Restoring...',
		'CMSMAIN.ERRORREVERTING': 'Error reverting to live content',
		'CMSMAIN.SAVING' : 'saving...',
		'CMSMAIN.SELECTMOREPAGES' : "You have %s pages selected.\n\nDo you really want to perform this action?",
		'ModelAdmin.SAVED': "Saved",
		'ModelAdmin.REALLYDELETE': "Do you really want to delete?",
		'ModelAdmin.DELETED': "Deleted",
		'ModelAdmin.VALIDATIONERROR': "Validation Error",
		'LeftAndMain.PAGEWASDELETED': "This page was deleted.  To edit a page, select it from the left.",
		'LeftAndMain.CONFIRMUNSAVED': "Are you sure you want to navigate away from this page?\n\nWARNING: Your changes have not been saved.\n\nPress OK to continue, or Cancel to stay on the current page.",
		'WidgetAreaEditor.TOOMANY': 'Sorry, you have reached the maximum number of widgets in this area',
		'CMSMAIN.RollbackConfirmation': 'Do you really want to roll back to version #%s of this page?',
		'CMSMAIN.CopyPublishedConfirmation': 'Do you really want to copy the published content to the stage site?',
		'CMSMAIN.PageTypeSaveAlert': 'The page type will be updated after the page is saved'
	});
}