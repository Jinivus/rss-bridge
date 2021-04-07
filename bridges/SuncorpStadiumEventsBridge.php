<?php
class SuncorpStadiumEventsBridge extends BridgeAbstract {

	const MAINTAINER = 'jinivus';
	const NAME = 'Suncorp Stadium Events';
	const URI = 'https://suncorpstadium.com.au/';
	const DESCRIPTION = 'Returns all events listed on https://suncorpstadium.com.au/what-s-on.aspx';

	public function collectData(){
		$html = '';
		$html = getSimpleHTMLDOM(static::URI . 'what-s-on.aspx')
			or returnClientError('No results for this query.');

		$dives = $html->find('div.event');

		foreach ($dives as $div) {
			$item = array();
			$item['title'] = $div->find('h6.event-title', 0)->plaintext;
			$item['content'] = $div->find('p.mt-2')->plaintext;
			$this->items[] = $item;
		}

	}
}
