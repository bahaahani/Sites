<?php
namespace Custom\Hello\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\BlockFactory;
use Magento\Cms\Model\BlockRepository;

class CreateHelloCmsBlock implements DataPatchInterface, PatchVersionInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var BlockFactory
     */
    private $blockFactory;

    /**
     * @var BlockRepository
     */
    private $blockRepository;

    /**
     * Constructor
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param BlockFactory $blockFactory
     * @param BlockRepository $blockRepository
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        BlockFactory $blockFactory,
        BlockRepository $blockRepository
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->blockFactory = $blockFactory;
        $this->blockRepository = $blockRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $block = $this->blockFactory->create();
        
        $block->setTitle('Hello World Banner Block')
            ->setIdentifier('hello_world_banner')
            ->setIsActive(true)
            ->setContent(
                '<div class="hello-world-cms-banner">
                    <style>
                        .hello-world-cms-banner {
                            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
                            color: white;
                            padding: 15px 20px;
                            text-align: center;
                            margin-bottom: 20px;
                            border-radius: 5px;
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                        }
                        .hello-world-cms-text {
                            text-align: left;
                        }
                        .hello-world-cms-text h3 {
                            margin: 0 0 5px 0;
                            font-size: 18px;
                            color: white;
                        }
                        .hello-world-cms-text p {
                            margin: 0;
                            font-size: 14px;
                        }
                        .hello-world-cms-btn {
                            display: inline-block;
                            padding: 8px 20px;
                            background: white;
                            color: #6a11cb;
                            font-weight: 600;
                            border-radius: 30px;
                            text-decoration: none;
                            transition: all 0.3s ease;
                            white-space: nowrap;
                        }
                        .hello-world-cms-btn:hover {
                            background: rgba(255,255,255,0.9);
                            transform: translateY(-2px);
                            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
                            text-decoration: none;
                        }
                    </style>
                
                    <div class="hello-world-cms-text">
                        <h3>Try Our Hello World Module</h3>
                        <p>Explore our custom module with professional UI/UX design</p>
                    </div>
                    <a href="{{store url="hello/index/index"}}" class="hello-world-cms-btn">
                        Experience It Now
                    </a>
                </div>'
            );
        
        $this->blockRepository->save($block);

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public static function getVersion()
    {
        return '1.0.1';
    }
} 