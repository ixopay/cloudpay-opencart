<?php
include_once(DIR_SYSTEM . 'library/cloudpay/autoload.php');

class ControllerExtensionModuleCloudPay extends Controller
{
    public function index()
    {
        $pluginData = new CloudPayPlugin();
        $this->load->language('extension/module/cloudpay');

        $this->document->setTitle($this->language->get('heading_title'));

        $data['error'] = '';
        if (isset($this->error['warning'])) {
            $data['error'] = $this->error['warning'];
        }

        $data['heading_title'] = $this->language->get('heading_title');
        $data['breadcrumbs'] = $this->getBreadcrumbs();
        $data['user_token'] = $this->session->data['user_token'];
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $data = array_merge($data, $pluginData->getTemplateData());

        $this->response->setOutput($this->load->view('extension/cloudpay/info', $data));
    }

    public function getBreadcrumbs()
    {
        $breadcrumbs = [];

        $breadcrumbs[] = [
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true),
        ];

        $breadcrumbs[] = [
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true),
        ];

        $breadcrumbs[] = [
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/cloudpay', 'user_token=' . $this->session->data['user_token'], true),
        ];

        return $breadcrumbs;
    }
}
