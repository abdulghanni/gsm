<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Template Library
 * Handle masterview and views within masterview
 */

class Template {

    private $_ci;

    protected $brand_name = 'GSM';
    protected $title_separator = ' - ';
    protected $ga_id = FALSE; // UA-XXXXX-X

    protected $layout = 'default';

    protected $title = FALSE;
    protected $description = FALSE;

    protected $metadata = array();

    protected $js = array();
    protected $css = array();
    protected $script = array();

    function __construct()
    {
        $this->_ci =& get_instance();
    }

    /**
     * Set page layout view (1 column, 2 column...)
     *
     * @access  public
     * @param   string  $layout
     * @return  void
     */
    public function set_layout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * Set page title
     *
     * @access  public
     * @param   string  $title
     * @return  void
     */
    public function set_title($title)
    {
        $this->title = $title;
    }

    /**
     * Set page description
     *
     * @access  public
     * @param   string  $description
     * @return  void
     */
    public function set_description($description)
    {
        $this->description = $description;
    }

    /**
     * Add metadata
     *
     * @access  public
     * @param   string  $name
     * @param   string  $content
     * @return  void
     */
    public function add_metadata($name, $content)
    {
        $name = htmlspecialchars(strip_tags($name));
        $content = htmlspecialchars(strip_tags($content));

        $this->metadata[$name] = $content;
    }

    /**
     * Add js file path
     *
     * @access  public
     * @param   string  $js
     * @return  void
     */
    public function add_js($js)
    {
        $this->js[$js] = $js;
    }

    public function add_script($script)
    {
        $this->script[$script] = $script;
    }

    /**
     * Add css file path
     *
     * @access  public
     * @param   string  $css
     * @return  void
     */
    public function add_css($css)
    {
        $this->css[$css] = $css;
    }

    /**
     * Load view
     *
     * @access  public
     * @param   string  $view
     * @param   mixed   $data
     * @param   boolean $return
     * @return  void
     */
    public function load_view($view, $data = array(), $return = FALSE)
    {
        // Not include master view on ajax request
        if ($this->_ci->input->is_ajax_request())
        {
            $this->_ci->load->view($view, $data);
            return;
        }

        // Title
        if (empty($this->title))
        {
            $title = $this->brand_name;
        }
        else
        {
            $title = $this->title . $this->title_separator . $this->brand_name;
        }

        // Description
        $description = $this->description;

        // Metadata
        $metadata = array();
        foreach ($this->metadata as $name => $content)
        {
            if (strpos($name, 'og:') === 0)
            {
                $metadata[] = '<meta property="' . $name . '" content="' . $content . '">';
            }
            else
            {
                $metadata[] = '<meta name="' . $name . '" content="' . $content . '">';
            }
        }
        $metadata = implode('', $metadata);

        // Javascript
        $js = array();
        foreach ($this->js as $js_file)
        {
            $js[] = '<script src="' . assets_url($js_file) . '"></script>';
        }
        $js = implode('', $js);

        // additionalscript
        $script = array();
        foreach ($this->script as $script_file)
        {
            $script[] = $script_file;
        }
        $script = implode('', $script);

        // CSS
        $css = array();
        foreach ($this->css as $css_file)
        {
            $css[] = '<link rel="stylesheet" href="' . assets_url($css_file) . '">';
        }
        $css = implode('', $css);

        //HEADER
        $photo = getValue('photo', 'users', array('id'=>'where/'.sessId()));
        $data['photo_profile'] = (!empty($photo)) ? base_url('uploads/'.sessId().'/80x80/'.$photo): assets_url('assets/images/no-image.png');
        $data['sess_name'] = getValue('username', 'users', array('id'=>'where/'.sessId()));
        $data['notification'] = GetAll('notifikasi', array('is_read'=>'where/0', 'receiver_id'=>'where/'.sessId(), 'limit'=>'limit/3', 'id'=>'order/desc'));
        $data['notifications'] = GetAll('notifikasi', array('is_read'=>'where/0', 'receiver_id'=>'where/'.sessId(), 'id'=>'order/desc'));
        $data['notification_num'] = GetAll('notifikasi', array('is_read'=>'where/0', 'receiver_id'=>'where/'.sessId()))->num_rows();

        //CHAT
        //$data['users'] = getAll('users', array('username'=>'order/asc'), array('!=id'=>sessId()));
        $data['users'] = getAll('users', array('username'=>'order/asc'));
        $data['unread_all'] = GetAllSelect('chat', 'is_read', array('is_read'=>'where/0', 'receiver_id'=>'where/'.sessId()))->num_rows();
        $data['messages'] = getAll('chat', array('receiver_id'=>'where/'.sessId(), 'limit'=>'limit/3', 'id'=>'order/desc'))->result();

        $header = $this->_ci->load->view('header', $data, TRUE);
        $chat_bar = $this->_ci->load->view('chat', $data, TRUE);
        $footer = $this->_ci->load->view('footer', array(), TRUE);
        $sidebar = $this->_ci->load->view('sidebar', array(), TRUE);
        $main_content = $this->_ci->load->view($view, $data, TRUE);

        $body = $this->_ci->load->view('layout/' . $this->layout, array(
            'header' => $header,
            'chat_bar' => $chat_bar,
            'footer' => $footer,
            'sidebar' => $sidebar,
            'main_content' => $main_content,
        ), TRUE);

        return $this->_ci->load->view('base_view', array(
            'title' => $title,
            'description' => $description,
            'metadata' => $metadata,
            'js' => $js,
            'css' => $css,
            'additionalscript' => $script,
            'body' => $body,
            'ga_id' => $this->ga_id,
        ), $return);
    }
}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */