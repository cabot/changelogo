// Validate and build URL
function getValidUrl(inputUrl) {
	let url = inputUrl.trim();
	if (!url) return '';

	if (!url.startsWith('http://') && !url.startsWith('https://')) {
		url = rootPath + url;
	}
	return url;
}

// Update image preview and dimensions
function updatePreview(url, previewElement, widthInput, heightInput) {
	const newImg = new Image();
	newImg.src = url;

	newImg.onload = function () {
		$(previewElement).attr('src', url);
		$(widthInput).val(newImg.width);
		$(heightInput).val(newImg.height);
	};
}

// Objects to store selectors
const selectors = {
	upload: '#changelogo_upload',
	url: '#changelogo_url',
	preview: '#changelogo_preview',
	width: '#changelogo_width',
	height: '#changelogo_height'
};

// File change event
$(selectors.upload).on('change', function () {
	const fileInput = $(this)[0];
	const file = fileInput.files[0];

	if (file) {
		const reader = new FileReader();

		reader.onload = function (event) {
			const fileUrl = event.target.result;
			updatePreview(fileUrl, selectors.preview, selectors.width, selectors.height);
			$(selectors.url).val(logoDestination + '/' + file.name);
		};

		reader.readAsDataURL(file);
	}
});

// Manual input event
$(selectors.url).on('input', function () {
	const inputUrl = $(this).val();
	const validUrl = getValidUrl(inputUrl);
	if (validUrl) {
		updatePreview(validUrl, selectors.preview, selectors.width, selectors.height);
	} else {
		$(selectors.preview).attr('src', '');
		$(selectors.width + ', ' + selectors.height).val('');
	}
});

// Form reset management
$('#acp_changelogo').on('reset', function () {
	setTimeout(function () {
		const resetLogoUrl = $(selectors.url).val();
		const validUrl = getValidUrl(resetLogoUrl);
		if (validUrl) {
			$(selectors.preview).attr('src', validUrl);
		} else {
			$(selectors.preview).attr('src', '');
		}
	}, 0);
});
