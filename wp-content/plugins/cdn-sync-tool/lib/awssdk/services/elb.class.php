<?php
/*
 * Copyright 2010 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License.
 * A copy of the License is located at
 *
 *  http://aws.amazon.com/apache2.0
 *
 * or in the "license" file accompanying this file. This file is distributed
 * on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

/**
 * File: AmazonELB
 * 	Elastic Load Balancing is a cost-effective and easy to use web service to help you improve
 * 	availability and scalability of your application. It makes it easy for you to distribute application
 * 	loads between two or more EC2 instances. Elastic Load Balancing enables availability through
 * 	redundancy and supports traffic growth of your application.
 *
 * Version:
 * 	Tue Nov 09 20:59:49 PST 2010
 *
 * License and Copyright:
 * 	See the included NOTICE.md file for complete information.
 *
 * See Also:
 * 	[Amazon Elastic Load Balancing](http://aws.amazon.com/elasticloadbalancing/)
 * 	[Amazon Elastic Load Balancing documentation](http://aws.amazon.com/documentation/elasticloadbalancing/)
 */


/*%******************************************************************************************%*/
// EXCEPTIONS

/**
 * Exception: ELB_Exception
 * 	Default ELB Exception.
 */
class ELB_Exception extends Exception {}


/*%******************************************************************************************%*/
// MAIN CLASS

/**
 * Class: AmazonELB
 * 	Container for all service-related methods.
 */
class AmazonELB extends CFRuntime
{

	/*%******************************************************************************************%*/
	// CLASS CONSTANTS

	/**
	 * Constant: DEFAULT_URL
	 * 	Specify the default queue URL.
	 */
	const DEFAULT_URL = 'elasticloadbalancing.us-east-1.amazonaws.com';

	/**
	 * Constant: REGION_US_E1
	 * 	Specify the queue URL for the US-East (Northern Virginia) Region.
	 */
	const REGION_US_E1 = self::DEFAULT_URL;

	/**
	 * Constant: REGION_US_W1
	 * 	Specify the queue URL for the US-West (Northern California) Region.
	 */
	const REGION_US_W1 = 'elasticloadbalancing.us-west-1.amazonaws.com';

	/**
	 * Constant: REGION_EU_W1
	 * 	Specify the queue URL for the EU (Ireland) Region.
	 */
	const REGION_EU_W1 = 'elasticloadbalancing.eu-west-1.amazonaws.com';

	/**
	 * Constant: REGION_APAC_SE1
	 * 	Specify the queue URL for the Asia Pacific (Singapore) Region.
	 */
	const REGION_APAC_SE1 = 'elasticloadbalancing.ap-southeast-1.amazonaws.com';


	/*%******************************************************************************************%*/
	// SETTERS

	/**
	 * Method: set_region()
	 * 	This allows you to explicitly sets the region for the service to use.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	$region - _string_ (Required) The region to explicitly set. Available options are <REGION_US_E1>, <REGION_US_W1>, <REGION_EU_W1>, or <REGION_APAC_SE1>.
	 *
	 * Returns:
	 * 	`$this`
	 */
	public function set_region($region)
	{
		$this->set_hostname($region);
		return $this;
	}


	/*%******************************************************************************************%*/
	// CONSTRUCTOR

	/**
	 * Method: __construct()
	 * 	Constructs a new instance of <AmazonELB>.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	$key - _string_ (Optional) Your Amazon API Key. If blank, it will look for the <AWS_KEY> constant.
	 * 	$secret_key - _string_ (Optional) Your Amazon API Secret Key. If blank, it will look for the <AWS_SECRET_KEY> constant.
	 *
	 * Returns:
	 * 	_boolean_ false if no valid values are set, otherwise true.
	 */
	public function __construct($key = null, $secret_key = null)
	{
		$this->api_version = '2010-07-01';
		$this->hostname = self::DEFAULT_URL;

		if (!$key && !defined('AWS_KEY'))
		{
			throw new ELB_Exception('No account key was passed into the constructor, nor was it set in the AWS_KEY constant.');
		}

		if (!$secret_key && !defined('AWS_SECRET_KEY'))
		{
			throw new ELB_Exception('No account secret was passed into the constructor, nor was it set in the AWS_SECRET_KEY constant.');
		}

		return parent::__construct($key, $secret_key);
	}


	/*%******************************************************************************************%*/
	// SERVICE METHODS

	/**
	 * Method: create_load_balancer_listeners()
	 * 	Creates one or more listeners on a LoadBalancer for the specified port. If a listener with the given
	 * 	port does not already exist, it will be created; otherwise, the properties of the new listener must
	 * 	match the properties of the existing listener.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$load_balancer_name - _string_ (Required) The name of the new LoadBalancer. The name must be unique within your AWS account.
	 *	$listeners - _ComplexList_ (Required) A list of LoadBalancerPort, `InstancePort`, `Protocol`, and `SSLCertificateID` items. A ComplexList is an indexed array of ComplexTypes. Each ComplexType is a set of key-value pairs which must be set by passing an associative array. In the descriptions below, `x`, `y` and `z` should be integers starting at `1`.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $listeners parameter:
	 *	Protocol - _string_ (Required) Specifies the LoadBalancer transport protocol to use for routing - TCP or HTTP. This property cannot be modified for the life of the LoadBalancer.
	 *	LoadBalancerPort - _integer_ (Required) Specifies the LoadBalancer transport protocol to use for routing - TCP or HTTP. This property cannot be modified for the life of the LoadBalancer.
	 *	InstancePort - _integer_ (Required) Specifies the TCP port on which the instance server is listening. This property cannot be modified for the life of the LoadBalancer.
	 *	SSLCertificateId - _string_ (Optional) The ID of the SSL certificate chain to use. For more information on SSL certificates, see Managing Keys and Certificates in the AWS Identity and Access Management documentation.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function create_load_balancer_listeners($load_balancer_name, $listeners, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['LoadBalancerName'] = $load_balancer_name;

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'Listeners.member' => (is_array($listeners) ? $listeners : array($listeners))
		)));

		return $this->authenticate('CreateLoadBalancerListeners', $opt, $this->hostname);
	}

	/**
	 * Method: create_lb_cookie_stickiness_policy()
	 * 	Generates a stickiness policy with sticky session lifetimes controlled by the lifetime of the
	 * 	browser (user-agent) or a specified expiration period. This policy can only be associated only with
	 * 	HTTP listeners.
	 *
	 * 	When a load balancer implements this policy, the load balancer uses a special cookie to track the
	 * 	backend server instance for each request. When the load balancer receives a request, it first checks
	 * 	to see if this cookie is present in the request. If so, the load balancer sends the request to the
	 * 	application server specified in the cookie. If not, the load balancer sends the request to a server
	 * 	that is chosen based on the existing load balancing algorithm.
	 *
	 * 	A cookie is inserted into the response for binding subsequent requests from the same user to that
	 * 	server. The validity of the cookie is based on the cookie expiration time, which is specified in the
	 * 	policy configuration.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$load_balancer_name - _string_ (Required) The name associated with the LoadBalancer. The name must be unique within the client AWS account.
	 *	$policy_name - _string_ (Required) The name of the policy being created. The name must be unique within the set of policies for this Load Balancer.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	CookieExpirationPeriod - _long_ (Optional) The time period in seconds after which the cookie should be considered stale. Not specifying this parameter indicates that the sticky session will last for the duration of the browser session.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function create_lb_cookie_stickiness_policy($load_balancer_name, $policy_name, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['LoadBalancerName'] = $load_balancer_name;
		$opt['PolicyName'] = $policy_name;

		return $this->authenticate('CreateLBCookieStickinessPolicy', $opt, $this->hostname);
	}

	/**
	 * Method: configure_health_check()
	 * 	Enables the client to define an application healthcheck for the instances.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$load_balancer_name - _string_ (Required) The mnemonic name associated with the LoadBalancer. This name must be unique within the client AWS account.
	 *	$health_check - _ComplexType_ (Required) A structure containing the configuration information for the new healthcheck. A required ComplexType is a set of key-value pairs which must be set by passing an associative array with certain entries as keys. See below for a list.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $health_check parameter:
	 *	Target - _string_ (Required) Specifies the instance being checked. The protocol is either TCP or HTTP. The range of valid ports is one (1) through 65535. TCP is the default, specified as a TCP: port pair, for example "TCP:5000". In this case a healthcheck simply attempts to open a TCP connection to the instance on the specified port. Failure to connect within the configured timeout is considered unhealthy. For HTTP, the situation is different. HTTP is specified as a HTTP:port;/;PathToPing; grouping, for example "HTTP:80/weather/us/wa/seattle". In this case, a HTTP GET request is issued to the instance on the given port and path. Any answer other than "200 OK" within the timeout period is considered unhealthy. The total length of the HTTP ping target needs to be 1024 16-bit Unicode characters or less.
	 *	Interval - _integer_ (Required) Specifies the approximate interval, in seconds, between health checks of an individual instance.
	 *	Timeout - _integer_ (Required) Specifies the amount of time, in seconds, during which no response means a failed health probe. This value must be less than the _Interval_ value.
	 *	UnhealthyThreshold - _integer_ (Required) Specifies the number of consecutive health probe failures required before moving the instance to the _Unhealthy_ state.
	 *	HealthyThreshold - _integer_ (Required) Specifies the number of consecutive health probe successes required before moving the instance to the _Healthy_ state.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function configure_health_check($load_balancer_name, $health_check, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['LoadBalancerName'] = $load_balancer_name;

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'HealthCheck' => (is_array($health_check) ? $health_check : array($health_check))
		)));

		return $this->authenticate('ConfigureHealthCheck', $opt, $this->hostname);
	}

	/**
	 * Method: describe_load_balancers()
	 * 	Returns detailed configuration information for the specified LoadBalancers. If no LoadBalancers are
	 * 	specified, the operation returns configuration information for all LoadBalancers created by the
	 * 	caller.
	 *
	 * 	The client must have created the specified input LoadBalancers in order to retrieve this
	 * 	information; the client must provide the same account credentials as those that were used to create
	 * 	the LoadBalancer.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	LoadBalancerNames - _string_|_array_ (Optional) A list of names associated with the LoadBalancers at creation time. Pass a string for a single value, or an indexed array for multiple values.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_load_balancers($opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['LoadBalancerNames']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'LoadBalancerNames.member' => (is_array($opt['LoadBalancerNames']) ? $opt['LoadBalancerNames'] : array($opt['LoadBalancerNames']))
			)));
			unset($opt['LoadBalancerNames']);
		}

		return $this->authenticate('DescribeLoadBalancers', $opt, $this->hostname);
	}

	/**
	 * Method: set_load_balancer_listener_ssl_certificate()
	 * 	Sets the certificate that terminates the specified listener's SSL connections. The specified
	 * 	certificate replaces any prior certificate that was used on the same LoadBalancer and port.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$load_balancer_name - _string_ (Required) The name of the the LoadBalancer.
	 *	$load_balancer_port - _integer_ (Required) The port that uses the specified SSL certificate.
	 *	$ssl_certificate_id - _string_ (Required) The ID of the SSL certificate chain to use. For more information on SSL certificates, see Managing Server Certificates in the AWS Identity and Access Management documentation.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function set_load_balancer_listener_ssl_certificate($load_balancer_name, $load_balancer_port, $ssl_certificate_id, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['LoadBalancerName'] = $load_balancer_name;
		$opt['LoadBalancerPort'] = $load_balancer_port;
		$opt['SSLCertificateId'] = $ssl_certificate_id;

		return $this->authenticate('SetLoadBalancerListenerSSLCertificate', $opt, $this->hostname);
	}

	/**
	 * Method: create_load_balancer()
	 * 	Creates a new LoadBalancer.
	 *
	 * 	Once the call has completed successfully, a new LoadBalancer is created; however, it will not be
	 * 	usable until at least one instance has been registered. When the LoadBalancer creation is completed,
	 * 	the client can check whether or not it is usable by using the DescribeInstanceHealth API. The
	 * 	LoadBalancer is usable as soon as any registered instance is InService.
	 *
	 * 	Currently, the client's quota of LoadBalancers is limited to five per Region.
	 *
	 * 	Load balancer DNS names vary depending on the Region they're created in. For load balancers created
	 * 	in the United States, the DNS name ends with:
	 *
	 * 	- us-east-1.elb.amazonaws.com (for the US Standard Region)
	 *
	 * 	- us-west-1.elb.amazonaws.com (for the Northern California Region)
	 *
	 * 	For load balancers created in the EU (Ireland) Region, the DNS name ends with:
	 *
	 * 	- eu-west-1.elb.amazonaws.com
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$load_balancer_name - _string_ (Required) The name associated with the LoadBalancer. The name must be unique within your set of LoadBalancers requests on the specified protocol and received by Elastic Load Balancing on the LoadBalancerPort are load balanced across the registered instances and sent to port InstancePort.
	 *	$listeners - _ComplexList_ (Required) A list of the following tuples: LoadBalancerPort, InstancePort, and Protocol. A ComplexList is an indexed array of ComplexTypes. Each ComplexType is a set of key-value pairs which must be set by passing an associative array. In the descriptions below, `x`, `y` and `z` should be integers starting at `1`.
	 *	$availability_zones - _string_|_array_ (Required) A list of Availability Zones. At least one Availability Zone must be specified. Specified Availability Zones must be in the same EC2 Region as the LoadBalancer. Traffic will be equally distributed across all zones. This list can be modified after the creation of the LoadBalancer. Pass a string for a single value, or an indexed array for multiple values.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $listeners parameter:
	 *	Protocol - _string_ (Required) Specifies the LoadBalancer transport protocol to use for routing - TCP or HTTP. This property cannot be modified for the life of the LoadBalancer.
	 *	LoadBalancerPort - _integer_ (Required) Specifies the LoadBalancer transport protocol to use for routing - TCP or HTTP. This property cannot be modified for the life of the LoadBalancer.
	 *	InstancePort - _integer_ (Required) Specifies the TCP port on which the instance server is listening. This property cannot be modified for the life of the LoadBalancer.
	 *	SSLCertificateId - _string_ (Optional) The ID of the SSL certificate chain to use. For more information on SSL certificates, see Managing Keys and Certificates in the AWS Identity and Access Management documentation.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function create_load_balancer($load_balancer_name, $listeners, $availability_zones, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['LoadBalancerName'] = $load_balancer_name;

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'Listeners.member' => (is_array($listeners) ? $listeners : array($listeners))
		)));

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'AvailabilityZones.member' => (is_array($availability_zones) ? $availability_zones : array($availability_zones))
		)));

		return $this->authenticate('CreateLoadBalancer', $opt, $this->hostname);
	}

	/**
	 * Method: enable_availability_zones_for_load_balancer()
	 * 	Adds one or more EC2 Availability Zones to the LoadBalancer.
	 *
	 * 	The LoadBalancer evenly distributes requests across all its registered Availability Zones that
	 * 	contain instances. As a result, the client must ensure that its LoadBalancer is appropriately scaled
	 * 	for each registered Availability Zone.
	 *
	 * 	The new EC2 Availability Zones to be added must be in the same EC2 Region as the Availability Zones
	 * 	for which the LoadBalancer was created.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$load_balancer_name - _string_ (Required) The name associated with the LoadBalancer. The name must be unique within the client AWS account.
	 *	$availability_zones - _string_|_array_ (Required) A list of new Availability Zones for the LoadBalancer. Each Availability Zone must be in the same Region as the LoadBalancer. Pass a string for a single value, or an indexed array for multiple values.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function enable_availability_zones_for_load_balancer($load_balancer_name, $availability_zones, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['LoadBalancerName'] = $load_balancer_name;

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'AvailabilityZones.member' => (is_array($availability_zones) ? $availability_zones : array($availability_zones))
		)));

		return $this->authenticate('EnableAvailabilityZonesForLoadBalancer', $opt, $this->hostname);
	}

	/**
	 * Method: describe_instance_health()
	 * 	Returns the current state of the instances of the specified LoadBalancer. If no instances are
	 * 	specified, the state of all the instances for the LoadBalancer is returned.
	 *
	 * 	The client must have created the specified input LoadBalancer in order to retrieve this
	 * 	information; the client must provide the same account credentials as those that were used to create
	 * 	the LoadBalancer.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$load_balancer_name - _string_ (Required) The name associated with the LoadBalancer. The name must be unique within the client AWS account.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	Instances - _ComplexList_ (Optional) A list of instance IDs whose states are being queried. A ComplexList is an indexed array of ComplexTypes. Each ComplexType is a set of key-value pairs. These pairs can be set one of two ways: by setting each individual `Instances` subtype (documented next), or by passing an associative array with the following `Instances`-prefixed entries as keys. In the descriptions below, `x`, `y` and `z` should be integers starting at `1`. See below for a list and a usage example.
	 *	Instances.x.InstanceId - _string_ (Optional) Provides an EC2 instance ID.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_instance_health($load_balancer_name, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['LoadBalancerName'] = $load_balancer_name;

		// Optional parameter
		if (isset($opt['Instances']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Instances.member' => $opt['Instances'])));
			unset($opt['Instances']);
		}

		return $this->authenticate('DescribeInstanceHealth', $opt, $this->hostname);
	}

	/**
	 * Method: delete_load_balancer_policy()
	 * 	Deletes a policy from the LoadBalancer. The specified policy must not be enabled for any listeners.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$load_balancer_name - _string_ (Required) The mnemonic name associated with the LoadBalancer. The name must be unique within your AWS account.
	 *	$policy_name - _string_ (Required) The mnemonic name for the policy being deleted.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function delete_load_balancer_policy($load_balancer_name, $policy_name, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['LoadBalancerName'] = $load_balancer_name;
		$opt['PolicyName'] = $policy_name;

		return $this->authenticate('DeleteLoadBalancerPolicy', $opt, $this->hostname);
	}

	/**
	 * Method: disable_availability_zones_for_load_balancer()
	 * 	Removes the specified EC2 Availability Zones from the set of configured Availability Zones for the
	 * 	LoadBalancer.
	 *
	 * 	There must be at least one Availability Zone registered with a LoadBalancer at all times. A client
	 * 	cannot remove all the Availability Zones from a LoadBalancer. Once an Availability Zone is removed,
	 * 	all the instances registered with the LoadBalancer that are in the removed Availability Zone go into
	 * 	the OutOfService state. Upon Availability Zone removal, the LoadBalancer attempts to equally balance
	 * 	the traffic among its remaining usable Availability Zones. Trying to remove an Availability Zone
	 * 	that was not associated with the LoadBalancer does nothing.
	 *
	 * 	In order for this call to be successful, the client must have created the LoadBalancer. The client
	 * 	must provide the same account credentials as those that were used to create the LoadBalancer.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$load_balancer_name - _string_ (Required) The name associated with the LoadBalancer. The name must be unique within the client AWS account.
	 *	$availability_zones - _string_|_array_ (Required) A list of Availability Zones to be removed from the LoadBalancer. There must be at least one Availability Zone registered with a LoadBalancer at all times. The client cannot remove all the Availability Zones from a LoadBalancer. Specified Availability Zones must be in the same Region. Pass a string for a single value, or an indexed array for multiple values.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function disable_availability_zones_for_load_balancer($load_balancer_name, $availability_zones, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['LoadBalancerName'] = $load_balancer_name;

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'AvailabilityZones.member' => (is_array($availability_zones) ? $availability_zones : array($availability_zones))
		)));

		return $this->authenticate('DisableAvailabilityZonesForLoadBalancer', $opt, $this->hostname);
	}

	/**
	 * Method: deregister_instances_from_load_balancer()
	 * 	Deregisters instances from the LoadBalancer. Once the instance is deregistered, it will stop
	 * 	receiving traffic from the LoadBalancer.
	 *
	 * 	In order to successfully call this API, the same account credentials as those used to create the
	 * 	LoadBalancer must be provided.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$load_balancer_name - _string_ (Required) The name associated with the LoadBalancer. The name must be unique within the client AWS account.
	 *	$instances - _ComplexList_ (Required) A list of EC2 instance IDs consisting of all instances to be deregistered. A ComplexList is an indexed array of ComplexTypes. Each ComplexType is a set of key-value pairs which must be set by passing an associative array. In the descriptions below, `x`, `y` and `z` should be integers starting at `1`.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $instances parameter:
	 *	InstanceId - _string_ (Optional) Provides an EC2 instance ID.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function deregister_instances_from_load_balancer($load_balancer_name, $instances, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['LoadBalancerName'] = $load_balancer_name;

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'Instances.member' => (is_array($instances) ? $instances : array($instances))
		)));

		return $this->authenticate('DeregisterInstancesFromLoadBalancer', $opt, $this->hostname);
	}

	/**
	 * Method: delete_load_balancer_listeners()
	 * 	Deletes listeners from the LoadBalancer for the specified port.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$load_balancer_name - _string_ (Required) The mnemonic name associated with the LoadBalancer.
	 *	LoadBalancerPorts - _integer_ (Required) The client port number(s) of the LoadBalancerListener(s) to be removed.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function delete_load_balancer_listeners($load_balancer_name, $load_balancer_ports, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['LoadBalancerName'] = $load_balancer_name;

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'LoadBalancerPorts.member' => (is_array($load_balancer_ports) ? $load_balancer_ports : array($load_balancer_ports))
		)));

		return $this->authenticate('DeleteLoadBalancerListeners', $opt, $this->hostname);
	}

	/**
	 * Method: delete_load_balancer()
	 * 	Deletes the specified LoadBalancer.
	 *
	 * 	If attempting to recreate the LoadBalancer, the client must reconfigure all the settings. The DNS
	 * 	name associated with a deleted LoadBalancer will no longer be usable. Once deleted, the name and
	 * 	associated DNS record of the LoadBalancer no longer exist and traffic sent to any of its IP
	 * 	addresses will no longer be delivered to client instances. The client will not receive the same DNS
	 * 	name even if a new LoadBalancer with same LoadBalancerName is created.
	 *
	 * 	To successfully call this API, the client must provide the same account credentials as were used to
	 * 	create the LoadBalancer.
	 *
	 * 	By design, if the LoadBalancer does not exist or has already been deleted, DeleteLoadBalancer still
	 * 	succeeds.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$load_balancer_name - _string_ (Required) The name associated with the LoadBalancer. The name must be unique within the client AWS account.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function delete_load_balancer($load_balancer_name, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['LoadBalancerName'] = $load_balancer_name;

		return $this->authenticate('DeleteLoadBalancer', $opt, $this->hostname);
	}

	/**
	 * Method: create_app_cookie_stickiness_policy()
	 * 	Generates a stickiness policy with sticky session lifetimes that follow that of an
	 * 	application-generated cookie. This policy can only be associated with HTTP listeners.
	 *
	 * 	This policy is similar to the policy created by CreateLBCookieStickinessPolicy, except that the
	 * 	lifetime of the special Elastic Load Balancing cookie follows the lifetime of the
	 * 	application-generated cookie specified in the policy configuration. The load balancer only inserts a
	 * 	new stickiness cookie when the application response includes a new application cookie.
	 *
	 * 	If the application cookie is explicitly removed or expires, the session stops being sticky until a
	 * 	new application cookie is issued.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$load_balancer_name - _string_ (Required) The name associated with the LoadBalancer. The name must be unique within the client AWS account.
	 *	$policy_name - _string_ (Required) The name of the policy being created. The name must be unique within the set of policies for this Load Balancer.
	 *	$cookie_name - _string_ (Required) Name of the application cookie used for stickiness.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function create_app_cookie_stickiness_policy($load_balancer_name, $policy_name, $cookie_name, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['LoadBalancerName'] = $load_balancer_name;
		$opt['PolicyName'] = $policy_name;
		$opt['CookieName'] = $cookie_name;

		return $this->authenticate('CreateAppCookieStickinessPolicy', $opt, $this->hostname);
	}

	/**
	 * Method: register_instances_with_load_balancer()
	 * 	Adds new instances to the LoadBalancer.
	 *
	 * 	Once the instance is registered, it starts receiving traffic and requests from the LoadBalancer.
	 * 	Any instance that is not in any of the Availability Zones registered for the LoadBalancer will be
	 * 	moved to the OutOfService state. It will move to the InService state when the Availability Zone is
	 * 	added to the LoadBalancer.
	 *
	 * 	In order for this call to be successful, the client must have created the LoadBalancer. The client
	 * 	must provide the same account credentials as those that were used to create the LoadBalancer.
	 *
	 * 	Completion of this API does not guarantee that operation has completed. Rather, it means that the
	 * 	request has been registered and the changes will happen shortly.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$load_balancer_name - _string_ (Required) The name associated with the LoadBalancer. The name must be unique within the client AWS account.
	 *	$instances - _ComplexList_ (Required) A list of instances IDs that should be registered with the LoadBalancer. A ComplexList is an indexed array of ComplexTypes. Each ComplexType is a set of key-value pairs which must be set by passing an associative array. In the descriptions below, `x`, `y` and `z` should be integers starting at `1`.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $instances parameter:
	 *	InstanceId - _string_ (Optional) Provides an EC2 instance ID.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function register_instances_with_load_balancer($load_balancer_name, $instances, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['LoadBalancerName'] = $load_balancer_name;

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'Instances.member' => (is_array($instances) ? $instances : array($instances))
		)));

		return $this->authenticate('RegisterInstancesWithLoadBalancer', $opt, $this->hostname);
	}

	/**
	 * Method: set_load_balancer_policies_of_listener()
	 * 	Associates, updates, or disables a policy with a listener on the load balancer. Currently only zero
	 * 	(0) or one (1) policy can be associated with a listener.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$load_balancer_name - _string_ (Required) The name associated with the LoadBalancer. The name must be unique within the client AWS account.
	 *	$load_balancer_port - _integer_ (Required) The external port of the LoadBalancer with which this policy has to be associated.
	 *	$policy_names - _string_|_array_ (Required) List of policies to be associated with the listener. Currently this list can have at most one policy. If the list is empty, the current policy is removed from the listener. Pass a string for a single value, or an indexed array for multiple values.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function set_load_balancer_policies_of_listener($load_balancer_name, $load_balancer_port, $policy_names, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['LoadBalancerName'] = $load_balancer_name;
		$opt['LoadBalancerPort'] = $load_balancer_port;

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'PolicyNames.member' => (is_array($policy_names) ? $policy_names : array($policy_names))
		)));

		return $this->authenticate('SetLoadBalancerPoliciesOfListener', $opt, $this->hostname);
	}
}

