<?php

class _FORM {
	static public function text ( $name, $value = '', $params = array() ) {
		$id = trim( $name, '[]' );

		return _FORM::none( '<input class="form-text" type="text" name="'.$name.'" id="'.$id.'" value="'.$value.'" />', $id );
	}

	static public function numeric ( $name, $value = '', $params = array() ) {
		$id = trim( $name, '[]' );

		return _FORM::none( '<input class="form-numeric" type="text" name="'.$name.'" id="'.$id.'" value="'.$value.'" />', $id );
	}

	static public function password ( $name, $value = '', $params = array() ) {
		$id = trim( $name, '[]' );

		return _FORM::none( '<input class="form-password" type="password" name="'.$name.'" id="'.$id.'" value="'.$value.'" />', $id );
	}

	static public function textarea ( $name, $value = '', $params = array() ) {
		$id = trim( $name, '[]' );

		return _FORM::none( '<textarea class="form-textarea" name="'.$name.'" id="'.$id.'">'.$value.'</textarea>', $id );
	}

	static public function select ( $name, $value = '', $params = array() ) {
		$id = trim( $name, '[]' );

		return _FORM::none( '<select class="form-select" name="'.$name.'" id="'.$id.'"><option value="0"><i>Selectionnez</i></option>'.$value.'</select>', $id );
	}

	static public function checkbox ( $name, $value = '', $params = array() ) {
		$id = trim( $name, '[]' );

		return _FORM::none( '<label class="form-checkbox"><input type="checkbox" name="'.$name.'" id="'.$id.'" /><span>'.$value.'</span></label>', $id );
	}

	static public function radio ( $name, $value = '', $params = array() ) {
		$id = trim( $name, '[]' );

		return _FORM::none( '<label class="form-radio"><input type="radio" name="'.$name.'" id="'.$id.'" /><span>'.$value.'</span></label>', $id );
	}

	static public function date ( $name, $value = '', $params = array() ) {
		$id = trim( $name, '[]' );

		return _FORM::none( '<input class="form-date datepicker" type="text" name="'.$name.'" id="'.$id.'" value="'.$value.'" />', $id );
	}

	static public function legend ( $text ) {
		return '<legend>'.$text.'</legend>';
	}

	static public function submit ( $text ) {
		return _BUTTON::submit( $text );
	}

	static public function hidden ( $name, $value = '', $params = array() ) {
		$id = trim( $name, '[]' );

		return '<input class="form-hidden" type="hidden" name="'.$name.'" id="'.$id.'" value="'.$value.'" />';
	}

	static public function upload ( $name, $value = '', $params = array() ) {
		$id = trim( $name, '[]' );

		return _FORM::none( '<input class="form-upload" type="file" name="'.$name.'" id="'.$id.'" value="'.$value.'" />', $id );
	}

	static public function none ( $content, $id = '' ) {
		$label = '>';
		if ( !empty( $id ) ) {
			$label = ' for="'.$id.'">'._( $id );
		}

		return '<p class="form"><label class="intitule"'.$label.'</label>'.$content.'</p>';
	}

	static public function verify ( $post = '' ) {
		$return = false;

		// provisoire
		if ( $post['action'] == 'add_module' && !empty( $post['Nom'] ) && !empty( $post['Alias'] ) ) {
			$return = true;
		}

		return $return;
	}
}