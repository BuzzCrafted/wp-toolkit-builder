<?php
/**
 * Asset_Meta_Test Class
 *
 * This class contains unit tests for the Asset_Meta class in the Asset Management system.
 *
 * @package    Bdev
 * @subpackage Tests
 * @since      1.0.0
 * @version    1.0.0
 * @license    GPL-2.0-or-later
 * @link       https://buzzdeveloper.net
 */

namespace Bdev\AssetManagement\Tests;

use PHPUnit\Framework\TestCase;
use Bdev\AssetManagement\Asset_Meta;
use Mockery;
use Brain\Monkey;
use Brain\Monkey\Functions;

/**
 * Class Asset_Meta_Test
 *
 * Unit test suite for testing the Asset_Meta class.
 *
 * @since 1.0.0
 */
class AssetMetaTest extends TestCase {

	/**
	 * Asset_Meta instance.
	 *
	 * @since 1.0.0
	 * @var Asset_Meta
	 */
	protected Asset_Meta $asset_meta;

	/**
	 * Path to the sample metadata file.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	protected string $sample_file_path;

	/**
	 * Set up the test environment.
	 *
	 * Initializes a new instance of Asset_Meta before each test.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	protected function setUp(): void {
		parent::setUp();
		Monkey\setUp();
		// Providing a sample file path to the constructor.
		$this->sample_file_path = 'file.php';
		$this->asset_meta       = new Asset_Meta( $this->sample_file_path );
	}

	/**
	 * Tear down the test environment.
	 *
	 * Cleans up after each test.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	protected function tearDown(): void {
		Monkey\tearDown();
		Mockery::close();
		parent::tearDown();
	}

	/**
	 * Test that the Asset_Meta instance is created correctly.
	 *
	 * Verifies that the created object is an instance of the Asset_Meta class.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function test_instance(): void {
		$this->assertInstanceOf( Asset_Meta::class, $this->asset_meta );
	}

	/**
	 * Test retrieving asset metadata.
	 *
	 * Verifies that the get_assets() method returns the expected metadata.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function test_get_assets(): void {
		// Mocking a valid asset metadata file response.
		$expected_assets = array(
			'dependencies' => array( 'jquery' ),
			'version'      => '1.0.0',
		);
		Functions\stubs(
			[
				'esc_attr',
				'esc_html',
				'__',
				'_x',
				'esc_attr__',
				'esc_html__',
			]
		);
		// Use vfsStream or a similar approach to create a virtual file for testing.
		file_put_contents( $this->sample_file_path, '<?php return ' . var_export( $expected_assets, true ) . ';' );

		$this->assertEquals( $expected_assets, $this->asset_meta->get_assets() );
	}

	/**
	 * Test retrieving asset metadata when file is invalid.
	 *
	 * Verifies that an exception is thrown if the metadata file cannot be read or is invalid.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function test_get_assets_invalid_file(): void {
		
		Functions\stubs(
			[
				'esc_attr',
				'esc_html',
				'__',
				'_x',
				'esc_attr__',
				'esc_html__',
			]
		);
		// Simulate an invalid file path scenario.
		$invalid_file_path = '/invalid/path/to/file.php';
		$this->asset_meta  = new Asset_Meta( $invalid_file_path );

		$this->expectException( \RuntimeException::class );
		$this->asset_meta->get_assets();
	}

	/**
	 * Test checking if the metadata file is readable.
	 *
	 * Verifies that is_valid() returns true if the file is readable.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function test_is_valid(): void {
		// Mocking file readability check.
		file_put_contents( $this->sample_file_path, '<?php return [];' );
		$this->assertTrue( $this->asset_meta->is_valid() );

		// Remove the file and check again.
		unlink( $this->sample_file_path );
		$this->assertFalse( $this->asset_meta->is_valid() );
	}
}
