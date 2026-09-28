import ImageSlider from "@src/js/components/cast/ImageSlider";
import React from "react";
import { createPortal } from "react-dom";

const ImageSliderPortal: React.FC = () => {
	const elem = document.getElementById("staff_slider_box");
	if (!elem) return null;

	const images = JSON.parse(elem.getAttribute("data-images") || "[]");
	const thumbnail = JSON.parse(elem.getAttribute("data-thumbnail") || "[]");

	return createPortal(
		<ImageSlider images={images} thumbnail={thumbnail} />,
		elem,
	);
};

export default ImageSliderPortal;
