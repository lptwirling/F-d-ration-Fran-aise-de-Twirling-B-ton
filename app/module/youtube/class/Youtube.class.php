<?php

class Youtube {
	private $user;
	public $videos;

	private $url = 'http://gdata.youtube.com/feeds/base/users/%s/uploads?alt=json&start-index=1&max-results=25&client=ytapi-youtube-profile&orderby=published&v=1';

	public function __construct ( $user = 'parweb29' )
	{
		$json = json_decode( file_get_contents( sprintf( $this->url, $user ) ), true );
		$this->videos = $json['feed']['entry'];

		if ( count( $this->videos ) ) {
			foreach ( $this->videos as $i => $video ) {
				$id = str_replace( 'http://gdata.youtube.com/feeds/base/videos/', '', $this->videos[$i]['id']['$t'] );
				
				$this->videos[$i]['image'] = "http://i.ytimg.com/vi/$id/2.jpg";
				$this->videos[$i]['id'] = $id;
				$this->videos[$i]['iframe'] = '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="200" src="http://www.youtube.com/embed/'.$id.'" frameborder="0" allowFullScreen></iframe>';
			}
		}
	}
}