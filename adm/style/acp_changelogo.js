/**
 * Validates and constructs a valid URL.
 *
 * If the provided URL does not start with "http://" or "https://", the `rootPath` is prepended to it.
 * Empty or whitespace-only URLs will return an empty string.
 *
 * @param {string} inputUrl - The URL provided by the user, which may need validation or modification.
 * @returns {string} A valid, fully constructed URL or an empty string if the input is invalid.
 */
function getValidUrl(inputUrl) {
	let url = inputUrl.trim();
	if (!url) return '';

	if (!url.startsWith('http://') && !url.startsWith('https://')) {
		url = rootPath + url;
	}
	return url;
}

/**
 * Updates the preview image and sets the width and height input values based on the image's dimensions.
 *
 * @param {string} url - The URL of the image to preview.
 * @param {HTMLElement|string} previewElement - The element or selector where the preview image will be displayed.
 * @param {HTMLElement|string} widthInput - The input element or selector where the image width will be set.
 * @param {HTMLElement|string} heightInput - The input element or selector where the image height will be set.
 */
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
