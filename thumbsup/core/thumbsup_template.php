<?php defined( 'THUMBSUP_DOCROOT' ) or exit( 'No direct script access.' );
/**
 * ThumbsUp Template
 *
 * @author     Geert De Deckere <//www.geertdedeckere.be/>
 * @copyright  (c) 2009 Geert De Deckere
 */

class ThumbsUp_Template {

	/**
	 * @var  string  template file
	 */
	protected $file;

	/**
	 * @var  array  data to pass on to the template
	 */
	protected $data;

	/**
	 * Creates a new template object. This method is chainable.
	 *
	 * @param   string  template file
	 * @return  object  ThumbsUp_Template
	 */
	public function factory( $file = null ) {
		return new ThumbsUp_Template( $file );
	}

	/**
	 * Constructor. Creates a new template object.
	 *
	 * @param   string  template file
	 * @return  void
	 */
	public function __construct( $file = null ) {
		$this->file = (string) $file;
	}

	/**
	 * Sets the template file. Overwrites the template file from the constructor.
	 * This method is chainable.
	 *
	 * @param   string  template file
	 * @return  object  ThumbsUp_Template
	 */
	public function set_file( $file ) {
		$this->file = (string) $file;

		// Chainable method
		return $this;
	}

	/**
	 * Sets template data. This method is chainable.
	 *
	 * @param   mixed   key string or an associative array for multiple variables at once
	 * @param   mixed   value
	 * @return  object  ThumbsUp_Template
	 */
	public function set( $key, $value = null ) {
		// Set multiple template variables at once
		if ( is_array( $key ) ) {
			foreach ( $key as $key2 => $value ) {
				$this->set( $key2, $value );
			}

			// Don't continue further if $key is an array
			return $this;
		}

		// Render nested templates first
		if ( $value instanceof ThumbsUp_Template ) {
			$value = $value->render( true );
		}

		// Update the data array
		$this->data[ $key ] = $value;

		// Chainable method
		return $this;
	}

	/**
	 * Sets template data.
	 *
	 * @param   string  key
	 * @param   mixed   value
	 * @return  void
	 */
	public function __set( $key, $value ) {
		$this->set( $key, $value );
	}

	/**
	 * Unsets template data (as of PHP 5.1.0).
	 *
	 * @param   string  key
	 * @return  void
	 */
	public function __unset( $key ) {
		unset( $this->data[ $key ] );
	}

	/**
	 * Checks whether certain template data is set (as of PHP 5.1.0).
	 *
	 * @param   string   template data key
	 * @return  boolean
	 */
	public function __isset( $key ) {
		return isset( $this->data[ $key ] );
	}

	/**
	 * Gets template data.
	 *
	 * @param   string  template data key
	 * @return  mixed   template data; NULL if not found
	 */
	public function __get( $key ) {
		return (isset( $this->data[ $key ] )) ? $this->data[ $key ] : null;
	}

	/**
	 * Renders a template, and outputs it (by default).
	 *
	 * @param   boolean  TRUE to return the output as a string instead of echoing it
	 * @return  mixed    void by default; string if $return has been set to TRUE
	 */
	public function render( $return = false ) {
		// Start output buffering
		ob_start();

		// Pass on the data to the template
		extract( (array) $this->data );

		// Load and parse the template
		include $this->file;

		// End output buffering
		$output = ob_get_contents();
		ob_end_clean();

		// Return the output as a string
		if ( $return === true ) {
			return $output;
		}

		// Print it
		echo $output;
	}

	/**
	 * Renders the template.
	 *
	 * @return  string  template output
	 */
	public function __toString() {
		return $this->render( true );
	}

}
