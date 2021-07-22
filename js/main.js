document.addEventListener(
	'DOMContentLoaded',
	function()
	{
		const ele = document
			.getElementById('chat');
		a.style.cursor = 'grab';
		let p = {
			top: 0,
			left: 0,
			x: 0,
			y: 0
		};
		const mouseDownHandler =
			function(e)
			{
				a.style.cursor =
					'grabbing';
				a.style.userSelect =
					'none';
				p = {
					left: a
						.scrollLeft,
					top: a
						.scrollTop,
					x: e.clientX,
					y: e.clientY,
				};
				document
					.addEventListener(
						'mousemove',
						mouseMoveHandler
						);
				document
					.addEventListener(
						'mouseup',
						mouseUpHandler
						);
			};
		const mouseMoveHandler =
			function(e)
			{
				const dx = e
					.clientX - p.x;
				const dy = e
					.clientY - p.y;
				a.scrollTop = p
					.top - dy;
				a.scrollLeft = p
					.left - dx;
			};
		const mouseUpHandler =
			function()
			{
				a.style.cursor =
					'grab';
				a.style
					.removeProperty(
						'user-select'
						);
				document
					.removeEventListener(
						'mousemove',
						mouseMoveHandler
						);
				document
					.removeEventListener(
						'mouseup',
						mouseUpHandler
						);
			};
		a.addEventListener(
			'mousedown',
			mouseDownHandler);
	});