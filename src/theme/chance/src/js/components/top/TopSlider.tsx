import Autoplay from "embla-carousel-autoplay";
import useEmblaCarousel from "embla-carousel-react";
import React, { useCallback, useState, useEffect } from "react";

export type SliderItem = {
	title: string;
	image: string;
	link: string;
};

type Props = {
	sliderData: SliderItem[];
};

type ThumbProps = {
	selected: boolean;
	onClick: () => void;
	src: string;
	title: string;
};

const Thumb: React.FC<ThumbProps> = ({ selected, onClick, src, title }) => {
	return (
		<div
			className={`top-slider__thumbs__slide${selected ? " top-slider__thumbs__slide--selected" : ""}`}
		>
			<button
				onClick={onClick}
				type="button"
				className="top-slider__thumbs__slide__button"
			>
				<img src={src} className="top-slider__thumbs__slide__img" alt={title} />
			</button>
		</div>
	);
};

const TopSlider: React.FC<Props> = ({ sliderData }) => {
	const [selectedIndex, setSelectedIndex] = useState(0);
	const [emblaMainRef, emblaMainApi] = useEmblaCarousel(
		{
			loop: true,
			align: "center",
		},
		[Autoplay({ delay: 10000, stopOnInteraction: false })],
	);
	const [emblaThumbsRef, emblaThumbsApi] = useEmblaCarousel({
		containScroll: "keepSnaps",
		dragFree: true,
	});

	const scrollPrev = useCallback(() => {
		if (emblaMainApi) emblaMainApi.scrollPrev();
	}, [emblaMainApi]);

	const scrollNext = useCallback(() => {
		if (emblaMainApi) emblaMainApi.scrollNext();
	}, [emblaMainApi]);

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
		<div className="top-slider">
			<div className="top-slider__viewport" ref={emblaMainRef}>
				<div className="top-slider__container">
					{sliderData.map((item, index) => (
						<div
							className="top-slider__slide"
							key={`slider-${item.image}-${index}`}
						>
							{item.link ? (
								<a href={item.link}>
									<img
										src={item.image}
										alt={item.title}
										className="top-slider__slide__img"
									/>
								</a>
							) : (
								<img
									src={item.image}
									alt={item.title}
									className="top-slider__slide__img"
								/>
							)}
						</div>
					))}
				</div>
			</div>
			<div className="top-slider__thumbs">
				<div className="top-slider__thumbs__viewport" ref={emblaThumbsRef}>
					<div className="top-slider__thumbs__container">
						{sliderData.map((item, index) => (
							<Thumb
								key={`thumb-${item.image}-${index}`}
								onClick={() => onThumbClick(index)}
								selected={index === selectedIndex}
								src={item.image}
								title={item.title}
							/>
						))}
					</div>
				</div>
			</div>
			<button
				type="button"
				className="top-slider__button top-slider__button--prev"
				onClick={scrollPrev}
			>
				<span className="bi bi-chevron-left" />
			</button>
			<button
				type="button"
				className="top-slider__button top-slider__button--next"
				onClick={scrollNext}
			>
				<span className="bi bi-chevron-right" />
			</button>
		</div>
	);
};

export default TopSlider;
