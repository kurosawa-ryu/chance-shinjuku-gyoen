import { Thumb } from "@src/js/components/cast/ImageSliderThumb";
import { EmblaOptionsType } from "embla-carousel";
import Fade from "embla-carousel-fade";
import useEmblaCarousel from "embla-carousel-react";
import React, { useState, useEffect, useCallback } from "react";

type Props = {
	images: string[];
	thumbnail: string[];
};

const ImageSlider: React.FC<Props> = ({ images, thumbnail }) => {
	const emblaOptions: EmblaOptionsType = {
		axis: "y",
		containScroll: "keepSnaps",
		dragFree: true,
	};
	// mdのサイズ以上はaxisをxにする
	if (window.innerWidth >= 768) {
		emblaOptions.axis = "x";
	}

	const [selectedIndex, setSelectedIndex] = useState(0);
	const [emblaMainRef, emblaMainApi] = useEmblaCarousel({}, [Fade()]);
	const [emblaThumbsRef, emblaThumbsApi] = useEmblaCarousel(emblaOptions);
	const onThumbClick = useCallback(
		(index: number) => {
			if (!emblaMainApi || !emblaThumbsApi) return;
			emblaMainApi.scrollTo(index);
		},
		[emblaMainApi, emblaThumbsApi],
	);

	const onSelect = useCallback(() => {
		if (!emblaMainApi || !emblaThumbsApi) return;
		setSelectedIndex(emblaMainApi.selectedScrollSnap());
		emblaThumbsApi.scrollTo(emblaMainApi.selectedScrollSnap());
	}, [emblaMainApi, emblaThumbsApi]);

	useEffect(() => {
		if (!emblaMainApi) return;
		onSelect();

		emblaMainApi.on("select", onSelect).on("reInit", onSelect);
	}, [emblaMainApi, onSelect]);

	return (
		<div className="image-slider">
			<div className="image-slider__viewport" ref={emblaMainRef}>
				<div className="image-slider__container">
					{images.map((image, index) => (
						<div className="image-slider__slide" key={image}>
							<img
								src={image}
								className="image-slider__slide__img"
								alt={`スライド ${index + 1}`}
							/>
						</div>
					))}
				</div>
			</div>

			<div className="image-slider__thumbs">
				<div className="image-slider__thumbs__viewport" ref={emblaThumbsRef}>
					<div className="image-slider__thumbs__container">
						{thumbnail.map((image, index) => (
							<Thumb
								key={image}
								onClick={() => onThumbClick(index)}
								selected={index === selectedIndex}
								index={index}
								src={image}
							/>
						))}
					</div>
				</div>
			</div>
		</div>
	);
};

export default ImageSlider;
